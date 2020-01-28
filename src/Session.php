<?php

namespace SobreFramework\Core;

/**
 * Class Session
 * @package SobreFramework\Core
 */
class Session
{
    protected static
        /** @var array The list of errors. */
        $errors = [],
        /** @var array The list of temporary variables. */
        $flashes = [],
        /** @var string The success message if there is no error. */
        $success,
        /** @var array THe list of variables. */
        $data = [];

    /**
     * Get the global session variable.
     *
     * @static
     * @return array
     */
    protected static function get(): array
    {
        return $_SESSION;
    }

    /**
     * Set a pair of key/value to the global session variable.
     *
     * @static
     * @param string $key
     * @param $value
     * @return void
     */
    protected static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Check if the global session variable has a given key.
     *
     * @static
     * @param string $key
     * @return bool
     */
    protected static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Start the session.
     *
     * @static
     * @return bool
     */
    public static function start(): bool
    {
        $result = session_start();

        if (!self::has('errors')) {
            self::set('errors', []);
        }

        if (!self::has('flashes')) {
            self::set('flashes', []);
        }

        if (!self::has('success')) {
            self::set('success', null);
        }

        if (!self::has('data')) {
            self::set('data', null);
        }

        return $result;
    }

    /**
     * Destroy the session.
     *
     * @static
     * @return bool
     */
    public static function destroy(): bool
    {
        return session_destroy();
    }

    /**
     * Get all the errors.
     *
     * @static
     * @return array
     */
    public static function getErrors(): array
    {
        return self::get()['errors'];
    }

    /**
     * Set the errors.
     *
     * @static
     * @param array $errors
     * @return void
     */
    public static function setErrors(array $errors): void
    {
        self::$errors = $errors;
        self::set('errors', $errors);
    }

    /**
     * Get the error of a given key.
     *
     * @static
     * @param string $key
     * @return string
     */
    public static function getError(string $key): string
    {
        return self::getErrors()[$key];
    }

    /**
     * Add an error.
     *
     * @static
     * @param string $key
     * @param string $error
     * @return void
     */
    public static function addError(string $key, string $error): void
    {
        self::$errors[$key] = $error;
        self::set('errors', self::$errors);
    }

    /**
     * Check if there is any error.
     *
     * @static
     * @return bool
     */
    public static function hasErrors(): bool
    {
        return !!self::getErrors();
    }

    /**
     * Check if an error for a given key exists or not.
     *
     * @static
     * @param string $key
     * @return bool
     */
    public static function hasError(string $key): bool
    {
        return isset(self::getErrors()[$key]);
    }

    /**
     * Get all flashes data.
     *
     * @static
     * @return array
     */
    public static function getFlashes(): array
    {
        return self::get()['flashes'];
    }

    /**
     * Set flashes data.
     *
     * @static
     * @param array $flashes
     * @return void
     */
    public static function setFlashes(array $flashes): void
    {
        self::$flashes = $flashes;
        self::set('flashes', $flashes);
    }

    /**
     * Get flash data of a given key.
     *
     * @static
     * @param string $key
     * @return mixed
     */
    public static function getFlash(string $key): string
    {
        return self::getFlashes()[$key];
    }

    /**
     * Add flash data for a given key.
     *
     * @static
     * @param string $key
     * @param mixed $flash
     */
    public static function addFlash(string $key, string $flash): void
    {
        self::$flashes[$key] = $flash;
        self::set('flashes', self::$flashes);
    }

    /**
     * Check if there is any flashes data.
     *
     * @static
     * @return bool
     */
    public static function hasFlashes(): bool
    {
        return !!self::getFlashes();
    }

    /**
     * Check if flash data of a given key exists.
     *
     * @static
     * @param string $key
     * @return bool
     */
    public static function hasFlash(string $key): bool
    {
        return isset(self::getFlashes()[$key]);
    }

    /**
     * Get the success message.
     *
     * @static
     * @return string|null
     */
    public static function getSuccess(): ?string
    {
        return self::get()['success'];
    }

    /**
     * Set the success message.
     *
     * @static
     * @param string|null $success
     * @return void
     */
    public static function setSuccess(?string $success = null): void
    {
        self::$success = $success;
        self::set('success', $success);
    }

    /**
     * Check if a success message has been setted.
     *
     * @static
     * @return bool
     */
    public static function hasSuccess(): bool
    {
        return !!self::getSuccess();
    }

    /**
     * Get all data or one item for a given key.
     *
     * @static
     * @param string|null $key
     * @return mixed
     */
    public static function data(?string $key = null)
    {
        if (func_num_args() > 1) {
            self::$data[$key] = func_get_arg(1);
            self::set('data', self::$data);
        }

        if ($key) {
            if (isset(self::get()['data'])) {
                return self::get()['data'][$key];
            }

            return null;
        }

        return self::$data;
    }

    /**
     * Check if data for a given key exists.
     *
     * @static
     * @param string $key
     * @return bool
     */
    public static function hasData(string $key): bool
    {
        return !is_null(self::data($key));
    }

    /**
     * Empty temporary data (errors, flashes data and success message).
     *
     * @static
     * @return void
     */
    public static function resetTemporaryData(): void
    {
        self::setErrors([]);
        self::setFlashes([]);
        self::setSuccess(null);
    }
}
