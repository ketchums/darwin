<?php

namespace App\Providers;

class RouteProvider {

    private static $routes = [];

    /**
     * Registers a route for the GET request method.
     *
     * @param string $route The route to register it to.
     * @param method $callback The callback to call if hit.
     */
    public static function get($route, $callback) {
        self::register($route, ['GET'], $callback);
    }

    /**
     * Registers a route for the POST request method.
     *
     * @param string $route The route to register it to.
     * @param method $callback The callback to call if hit.
     */
    public static function post($route, $callback) {
        self::register($route, ['POST'], $callback);
    }

    /**
     * Registers a route for all request methods
     *
     * @param string $route The route to register it to.
     * @param method $callback The callback to call if hit.
     */
    public static function any($route, $callback) {
        self::register($route, ['GET', 'POST'], $callback);
    }

    /**
     * Registers a route with custom methods array.
     *
     * @param string $route The route to register it to.
     * @param array $methods The array of methods to accept.
     * @param method $callback The callback to call if hit.
     */
    public static function add($route, $methods, $callback) {
        self::register($route, $methods, $callback);
    }

    /**
     * Registers a route, or appends the methods if exists.
     *
     * @param string $route The route to register it to.
     * @param array $methods The array of methods to accept.
     * @param method $callback The callback to call if hit.
     */
    private static function register($route, $methods, $callback) {
        if (array_key_exists($route, self::$routes)) {
            array_push(self::$routes[$route][0], $methods);
            return;
        }

        self::$routes[$route] = [$methods, $callback];
    }
    
    /**
     * Executes the callback for the selected route.
     *
     * @param string $route The route to associate the callback with.
     */
    public static function resolve($route) {
        $routeConfig = self::$routes[$route];
        $methodsAllowed = $routeConfig[0];
        $method = $_SERVER['REQUEST_METHOD'];

        if (!in_array($method, $methodsAllowed)) {
            exit('method not allowed');
        }

        $callback = $routeConfig[1];

        if (is_callable($callback)) {
            $callback();
        }
    }
}