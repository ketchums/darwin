<?php

namespace App\Providers;

class DependencyProvider {

    private static $cache = [];

    public static function register($name, $class) {
        self::$cache[$name] = $class;
    }

    public function fetch($name) {
        return self::$cache[$name];
    }
}