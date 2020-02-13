<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response, array $args){
    $response->getBody()->write('Index');
    return $response;
});

$app->get('/user/add', \App\Controllers\User\Action\Add::class);
$app->get('/user/delete', \App\Controllers\User\Action\Delete::class);
$app->get('/user/show', \App\Controllers\User\Action\Show::class);

$app->run();
