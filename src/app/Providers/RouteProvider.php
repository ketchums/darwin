<?php

class RouteProvider {

    private static $routes = [];

    public static function get($route, $callback) {
        self::register($route, 'GET', $callback);
    }

    public static function post($route, $callback) {
        self::register($route, 'POST', $callback);
    }

    public static function add($route, $method, $callback) {
        self::register($route, $method, $callback);
    }

    private static function register($route, $method, $callback) {
        self::$routes[$route] = [$method, $callback];
    }
    
    public static function resolve($route, $method) {
        $routeConfig = self::$routes[$route];
        $methodsAllowed = $routeConfig[0];

        if ((is_array($methodsAllowed) && !in_array($method, $methodsAllowed)) || $methodsAllowed != $method) {
            exit('method not allowed');
        }

        var_dump($methodsAllowed);
    }
}