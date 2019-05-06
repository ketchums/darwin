<?php

use App\Providers\RouteProvider;

RouteProvider::any('/', ['SomeController', 'someMethod']);
RouteProvider::resolve($_SERVER['REQUEST_URI']);