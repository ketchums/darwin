<?php

namespace App\Providers;

class RouteProvider {

    private $routes = [];

    /**
     * Registers a route for the GET request method.
     *
     * @param string $route The route to register it to.
     * @param method $callback The callback to call if hit.
     */
    public function get($route, $callback) {
        $this->register($route, ['GET'], $callback);
    }

    /**
     * Registers a route for the POST request method.
     *
     * @param string $route The route to register it to.
     * @param method $callback The callback to call if hit.
     */
    public function post($route, $callback) {
        $this->register($route, ['POST'], $callback);
    }

    /**
     * Registers a route for all request methods
     *
     * @param string $route The route to register it to.
     * @param method $callback The callback to call if hit.
     */
    public function any($route, $callback) {
        $this->register($route, ['GET', 'POST'], $callback);
    }

    /**
     * Registers a route with custom methods array.
     *
     * @param string $route The route to register it to.
     * @param array $methods The array of methods to accept.
     * @param method $callback The callback to call if hit.
     */
    public function add($route, $methods, $callback) {
        $this->register($route, $methods, $callback);
    }

    /**
     * Registers a route, or appends the methods if exists.
     *
     * @param string $route The route to register it to.
     * @param array $methods The array of methods to accept.
     * @param method $callback The callback to call if hit.
     */
    private function register($route, $methods, $callback) {
        if (array_key_exists($route, $this->routes)) {
            array_push($this->routes[$route][0], $methods);
            return;
        }

        $this->routes[$route] = [$methods, $callback];
    }
    
    /**
     * Executes the callback for the selected route.
     *
     * @param string $route The route to associate the callback with.
     */
    public function resolve($route) {
        if (!array_key_exists($route, $this->routes)) {
            exit('TODO: 404');
        }

        $routeConfig = $this->routes[$route];
        $methodsAllowed = $routeConfig[0];
        $method = $_SERVER['REQUEST_METHOD'];

        if (!in_array($method, $methodsAllowed)) {
            exit('TODO: 405');
        }

        $callback = $routeConfig[1];

        if (is_callable($callback)) {
            $callback();
        }
        else {
            call_user_func(array(DependencyProvider::fetch($callback[0]), $callback[1])); 
        }
    }
}