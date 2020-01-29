<?php

namespace SobreFramework\Core;

use \PDO;

/**
 * Class Database
 * @package SobreFramework\Core
 */
class Database
{
    protected
        /** @var PDO The PDO instance which interacts with the database. */
        $pdo;

    /**
     * Database constructor.
     *
     * @constructor
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * Connect the PDO instance with the database.
     *
     * @return $this
     */
    public function connect(): self
    {
        if (env('DATABASE_SYSTEM', config('database.system', null))) {
            $this->setPdo(new \PDO('sqlite:database/database.db'));

            $this->getPdo()->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->getPdo()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this;
        }
    }

    /**
     * Fetch all data got through a SELECT SQL query.
     *
     * @param string $query
     * @param array|null $data
     * @param string|null $class
     * @return array
     */
    public function fetch(string $query, ?array $data = null, ?string $class = null): array
    {
        $statement = $this->getPdo()->prepare($query);
        $statement->execute($data);

        return ($class) ? $statement->fetchAll(PDO::FETCH_CLASS, $class) : $statement->fetchAll();
    }

    /**
     * Execute a SQL query. For a SELECT one, use instead Database::fetch().
     *
     * @param string $query
     * @param array|null $data
     * @return bool
     */
    public function exec(string $query, ?array $data = null): bool
    {
        $statement = $this->getPdo()->prepare($query);
        $result = $statement->execute($data);

        return $result;
    }

    /**
     * Get the PDO instance which interacts with the database.
     *
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * Set the PDO instance which interacts with the database.
     *
     * @param PDO $pdo
     * @return $this
     */
    public function setPdo(PDO $pdo): self
    {
        $this->pdo = $pdo;

        return $this;
    }

    /**
     * Get the database instance of the application. Alias for Core::database().
     *
     * @static
     * @return Database
     */
    public static function get(): Database
    {
        return Core::database();
    }

    /**
     * Reset the SQLite database file.
     *
     * @static
     * @return void
     */
    public static function reset(): void
    {
        if (file_exists('database/database.db')) {
            unlink('database/database.db');
        }

        copy('database/database.empty.db', 'database/database.db');
    }
}