<?php

use DI\Container;
use Slim\Factory\AppFactory;

define('ROOT', dirname(__DIR__) . '/');

require ROOT . 'vendor/autoload.php';

$container = new Container();

$settings = require ROOT . 'config/settings.php';
$settings($container);

$settings = require ROOT . 'config/database.php';
$settings($container);

// Set Container on app
AppFactory::setContainer($container);

// Create App
$app = AppFactory::create();

$views = require ROOT . 'config/views.php';
$views($app);

$middleware = require ROOT . 'config/middleware.php';
$middleware($app);

$routes = require ROOT . 'config/routes.php';
$routes($app);

// Run App
$app->run();
