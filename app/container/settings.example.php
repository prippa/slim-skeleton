<?php

use DI\Container;

return function (Container $container)
{
    $container->set('settings', function ()
    {
        return [
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
                'dbname' => 'db',
                'host' => '127.0.0.1',
                'user' => 'root',
                'password' => 'root',
            ],
        ];
    });
};
