<?php

RouteProvider::any('/', function() {
    echo 'Welcome to Darwin framework.';
});

RouteProvider::resolve('/');