<?php

namespace app\core;

use PDO;
use PDOStatement;

/**
 * Class DB
 * @package app\core
 */
class DB
{
    /**
     * @var PDO
     */
    public $db;

    /**
     * Connect to DB
     * @param string $dbname
     * @param string $host
     * @param string $user
     * @param string $pass
     */
    public function __construct(string $dbname, string $host, string $user, string $pass)
    {
        $dsn = "mysql:dbname=$dbname;host=$host";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $this->db = new PDO($dsn, $user, $pass, $options);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool|PDOStatement
     */
    public function execute(string $sql, array $params = [])
    {
        $result = $this->db->prepare($sql);

        $result->execute($params);

        return $result;
    }
}
