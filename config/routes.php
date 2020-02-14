<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app)
{
    $app->get('/', \app\controllers\site\Index::class);

    $app->group('/user/', function (RouteCollectorProxy $group)
    {
        $group->get('add/{name}', \app\controllers\user\Add::class);
        $group->get('delete/{id}', \app\controllers\user\Delete::class);
    });
};
