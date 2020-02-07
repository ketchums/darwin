<?php

$router = new App\Providers\RouteProvider();

$router->addGet('/', ['App\Controllers\SomeController', 'someMethod']);

echo $router->getResponse($_SERVER['REQUEST_URI'])->getResponseText();