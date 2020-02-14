<?php

use DI\Container;

return function (Container $container)
{
    $container->set('settings', function ()
    {
        return [
            'name' => 'Slim 4 MVC Skeleton',
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
            'views' => [
                'path' => ROOT . 'src/views',
                'settings' => [
                    'cache' => false
                ],
            ],
        ];
    });
};
