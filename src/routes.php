<?php

use App\Providers\RouteProvider;

RouteProvider::any('/', function() {
    echo 'Welcome to Darwin framework.';
});

RouteProvider::resolve('/');