<?php

namespace app\core;

class Model
{
    /**
     * @var DB object
     */
    private static $db = null;

    /**
     * Get DB object
     * @return DB
     */
    public static function db()
    {
        if (!self::$db) {
            $settings = require ROOT . 'config/database.php';

            self::$db = new DB(
                $settings['dbname'],
                $settings['host'],
                $settings['user'],
                $settings['pass']
            );
        }

        return self::$db;
    }
}
