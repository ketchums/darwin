<?php

include ROOT . '/vendor/autoload.php';

use App\Providers\DependencyProvider;
use App\Controllers\SomeController;

DependencyProvider::register('SomeController', new SomeController());

include ROOT . '/src/routes.php';