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
    public function addGet($route, $callback) {
        $this->add($route, ['GET'], $callback);
    }

    /**
     * Registers a route for the POST request method.
     *
     * @param string $route The route to register it to.
     * @param method $callback The callback to call if hit.
     */
    public function addPost($route, $callback) {
        $this->add($route, ['POST'], $callback);
    }

    /**
     * Registers a route with custom methods array.
     *
     * @param string $route The route to register it to.
     * @param array $methods The array of methods to accept.
     * @param method $callback The callback to call if hit.
     */
    public function add($route, $methods, $callback) {
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