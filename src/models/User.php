<?php

namespace app\models;

use app\core\Model;

abstract class User extends Model
{
    /**
     * Table name
     */
    private const TABLE = 'test';

    public static function add(string $name)
    {
        return self::db()->insert(self::TABLE, ['name', $name]);
    }

    public static function delete(int $id)
    {
        return self::db()->delete(self::TABLE, ['id', $id], 1);
    }
}
