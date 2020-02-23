<?php

use DI\Container;
use Slim\Factory\AppFactory;

define('ROOT', dirname(__DIR__) . '/');

require ROOT . 'vendor/autoload.php';

$container = new Container();

$settings = require ROOT . 'app/container/settings.php';
$settings($container);

$database = require ROOT . 'app/container/database_connection.php';
$database($container);

// Set Container on app
AppFactory::setContainer($container);

// Create App
$app = AppFactory::create();

$views = require ROOT . 'app/views.php';
$views($app);

$middleware = require ROOT . 'app/middleware.php';
$middleware($app);

$routes = require ROOT . 'app/routes.php';
$routes($app);

// Run App
$app->run();
