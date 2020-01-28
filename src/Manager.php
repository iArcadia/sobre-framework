<?php

namespace SobreFramework\Core;

use Symfony\Component\VarDumper\Cloner\Data;

/**
 * Class Manager
 * @package SobreFramework\Core
 */
class Manager
{
    protected static
        /** @var string The table name. */
        $table,
        /** @var string The class name. */
        $class,
        /** @var array The list of properties to use for inserting into the DB. */
        $insert_properties = [],
        /** @var array The list of properties to use for updating the DB. */
        $update_properties = [];

    /**
     * Get the table name.
     *
     * @static
     * @return string
     */
    public static function getTable(): string
    {
        $table = static::$table;

        if (!$table) {
            $table = str_replace('Manager', '', static::class);
            $table = strtolower($table);
            $table = preg_replace('/.*\\\\(.+)$/', '$1', $table);
            $table .= 's';
        }

        return $table;
    }

    /**
     * Get the class name.
     *
     * @static
     * @return string
     */
    public static function getClass(): string
    {
        return static::$class ?? str_replace('Manager', '', static::class);
    }

    /**
     * Get all items of the table.
     *
     * @static
     * @return array
     */
    public static function all(): array
    {
        $query = "SELECT * FROM " . Database::get()->getPdo()->quote(static::getTable()) . " ORDER BY UPPER(name) ASC";

        return Database::get()->fetch($query, null, static::getClass());
    }

    /**
     * Count the number of items from the table.
     *
     * @static
     * @return int
     */
    public static function count(): int
    {
        $query = "SELECT COUNT(*) AS n FROM " . Database::get()->getPdo()->quote(static::getTable());

        return (int)Database::get()->fetch($query)[0]['n'];
    }

    /**
     * Get item from the table for a pagination feature.
     *
     * @static
     * @param int $page
     * @param int $n
     * @param bool $with_destroyed
     * @return array
     */
    public static function page(int $page = 1, int $n = 20, bool $with_destroyed = false): array
    {
        $class = static::getClass();
        $offset = $n * ($page - 1);
        $query_where = ($with_destroyed
            && property_exists($class, 'destroyed_at')
            && property_exists($class, 'destroyed_by'))
            ? " WHERE destroyed_at IS NULL " : '';

        $query = "SELECT * FROM " . Database::get()->getPdo()->quote(static::getTable()) . $query_where . " ORDER BY UPPER(name) ASC LIMIT " . $offset . ", " . $n;

        return Database::get()->fetch($query, null, $class);
    }

    /**
     * Find an item from the table by its ID.
     *
     * @static
     * @param int $id
     * @return array
     */
    public static function find(int $id)
    {
        $query = "SELECT * FROM " . static::getTable() . " WHERE id = ?";

        $item = Database::get()->fetch($query, [$id], static::getClass());

        return ($item) ? $item[0] : $item;
    }

    /**
     * Find many items from the table by their ID.
     *
     * @static
     * @param string|array $ids
     * @return array
     */
    public static function findMany($ids): array
    {
        if (is_array($ids)) {
            $ids = join(',', $ids);
        }

        $ids = Database::get()->getPdo()->quote($ids);

        $query = "SELECT * FROM " . static::getTable() . " WHERE id IN (%s)";

        return Database::get()->fetch(sprintf($query, $ids), null, static::getClass());
    }

    /**
     * Find an item from the table by a given attribute.
     *
     * @static
     * @param string $attribute
     * @param $value
     * @return mixed|null
     */
    public static function findBy(string $attribute, $value)
    {
        $item = self::findManyBy($attribute, $value);

        return ($item) ? $item[0] : null;
    }

    /**
     * Find many items from the table by a given attribute.
     *
     * @static
     * @param string $attribute
     * @param $value
     * @return array
     */
    public static function findManyBy(string $attribute, $value): array
    {
        $query = "SELECT * FROM " . static::getTable() . " WHERE " . $attribute . " = :value";

        return Database::get()->fetch($query, [':value' => $value], static::getClass());
    }

    /**
     * Insert a class instance into the table.
     *
     * @static
     * @param $obj
     * @return bool
     */
    public static function insert(&$obj): bool
    {
        $table = Database::get()->getPdo()->quote(static::getTable());

        $values = array_map(function ($property) {
            return ':' . $property;
        }, static::$insert_properties);

        $query = "
            INSERT INTO
                " . $table . " (" . join(',', static::$insert_properties) . ", created_at)
            VALUES
                (" . join(',', $values) . ", CURRENT_TIMESTAMP)
        ";

        $data = [];

        foreach (static::$insert_properties as $property) {
            $getter = 'get' . snakeToCamel($property);

            $data[':' . $property] = $obj->$getter();
        }

        $result = Database::get()->exec($query, $data);

        $class = static::getClass();
        $manager = $class::manager();

        $obj = $manager::find(Database::get()->getPdo()->lastInsertId());

        return $result;
    }

    /**
     * Update an item of the table by class instance properties.
     *
     * @static
     * @param $obj
     * @return bool
     */
    public static function update(&$obj): bool
    {
        $table = Database::get()->getPdo()->quote(static::getTable());

        $set = array_map(function ($property) {
            return $property . ' = :' . $property;
        }, static::$update_properties);

        $query = "
            UPDATE
                " . $table . "
            SET
                " . join(',', $set) . ", updated_at = CURRENT_TIMESTAMP
            WHERE
                id = :id
        ";

        $data = [
            ':id' => $obj->getId()
        ];

        foreach (static::$update_properties as $property) {
            $getter = 'get' . snakeToCamel($property);

            $data[':' . $property] = $obj->$getter();
        }

        $result = Database::get()->exec($query, $data, $obj);

        $class = static::getClass();
        $manager = $class::manager();

        $obj = $manager::find($obj->getId());

        return $result;
    }

    /**
     * Delete an item from the table.
     *
     * @static
     * @param $obj
     * @return bool
     */
    public static function destroy($obj): bool
    {
        if (property_exists($obj, 'destroyed_at') && property_exists($obj, 'destroyed_by')) {
            $query = "
                UPDATE
                    " . static::getTable() . "
                SET
                    destroyed_at = CURRENT_TIMESTAMP
                WHERE
                    id = :id
            ";

            $data = [
                ':id' => $obj->getId()
            ];

            return Database::get()->exec($query, $data);
        }

        return static::hardDestroy($obj);
    }

    /**
     * Delete definitively an item from the table.
     *
     * @static
     * @param $obj
     * @return bool
     */
    public static function hardDestroy($obj): bool
    {
        $query = "
            DELETE FROM
                " . static::getTable() . "
            WHERE
                id = :id
        ";

        $data = [
            ':id' => $obj->getId()
        ];

        return Database::get()->exec($query, $data);
    }
}