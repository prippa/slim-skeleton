<?php

use DI\Container;

return function (Container $container)
{
    $container->set('settings', function ()
    {
        return [
            'name' => 'Slim 4 MVC Skeleton',
            'displayErrorDetails' => true, // Set to false in production
            'logErrorDetails' => true,
            'logErrors' => true,
            'views' => [
                'path' => ROOT . 'src/views',
                'settings' => [
                    'cache' => false // Set ROOT . 'var/cache/twig' in production
                ],
            ],
            'database' => [
                'dbname' => 'test',
                'host' => '127.0.0.1',
                'user' => 'root',
                'pass' => '123123123',
            ]
        ];
    });
};
