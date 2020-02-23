<?php

use Slim\App;

return function (App $app)
{
    $app->get('/', \app\controllers\User::class.':showGet')->setName('showUsers');
    $app->get('/add', \app\controllers\User::class.':addGet');
    $app->post('/add', \app\controllers\User::class.':addPost');
};
