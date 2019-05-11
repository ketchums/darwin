<?php

namespace App\Providers;

class DependencyProvider {

    /**
     * The cache to hold class names and objects.
     */
    private static $cache = [];

    /**
     * Registers a class object to the cache array.
     *
     * @param string $name The name of the class to access array value later.
     * @param object $class The class object to associate with the name.
     */
    public static function register($name, $class) {
        self::$cache[$name] = $class;
    }

    /**
     * Returns the class object associated with the name passed, creates the object if missing.
     *
     * @param string $name The name of the class to return the object for.
     */
    public function fetch($name) {
        if (!array_key_exists($name, self::$cache)) {
            self::register($name, new $name());
        }

        return self::$cache[$name];
    }
}