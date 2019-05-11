<?php

use App\Providers\RouteProvider;

RouteProvider::any('/', ['App\Controllers\SomeController', 'someMethod']);
RouteProvider::resolve($_SERVER['REQUEST_URI']);