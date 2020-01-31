<?php

$router = new App\Providers\RouteProvider();

$router->any('/', ['App\Controllers\SomeController', 'someMethod']);
$router->resolve($_SERVER['REQUEST_URI']);