<?php

use app\core\DB;
use DI\Container;

return function (Container $container)
{
    $container->set('database_connection', function() use ($container)
    {
        $settings = $container->get('settings')['database'];

        return new DB(
            $settings['dbname'],
            $settings['host'],
            $settings['user'],
            $settings['password']
        );
    });
};
