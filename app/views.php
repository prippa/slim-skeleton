<?php

use Slim\App;
use Slim\Views\Twig;
use Twig\Loader\FilesystemLoader;

return function (App $app)
{
    $container = $app->getContainer();

    $container->set('view', function() use ($container)
    {
        $settings = $container->get('settings')['views'];
        $loader = new FilesystemLoader($settings['path']);

        return new Twig($loader, $settings['settings']);
    });
};
