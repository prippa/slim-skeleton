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
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $this->db = new PDO($dsn, $user, $pass, $options);
    }

    /**
     * @param string $table
     * @param array $params
     * @return bool|PDOStatement
     */
    public function insert(string $table, array $params)
    {
        $fields = '';
        $values = '';
        $count = count($params);

        for ($i = 0; ($i + 1) < $count; $i += 2) {
            $key = $params[$i];
            $fields .= "$key,";
            $values .= ":$key,";
        }
        $fields = rtrim($fields, ',');
        $values = rtrim($values, ',');

        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        return $this->execute($sql, $params);
    }

    /**
     * @param string $table
     * @param array $where
     * @param int|null $limit
     * @return bool|PDOStatement
     */
    public function delete(string $table, array $where, int $limit = null)
    {
        $where_string = $this->prepareWhere($where);
        $sql = "DELETE FROM $table WHERE $where_string";
        if ($limit) {
            $sql .= " LIMIT $limit";
        }
        return $this->execute($sql, $where);
    }

    /**
     * @param string $table
     * @param array $params
     * @param array $where
     * @param int|null $limit
     * @return bool|PDOStatement
     */
    public function update(string $table, array $params, array $where, int $limit = null)
    {
        $setString = '';
        $where_string = $this->prepareWhere($where);
        $count = count($params);

        for ($i = 0; ($i + 1) < $count; $i += 2) {
            $key = $params[$i];
            $setString .= "$key = :$key,";
        }
        $setString = rtrim($setString, ',');
        $sql = "UPDATE $table SET $setString WHERE $where_string";
        if ($limit) {
            $sql .= " LIMIT $limit";
        }
        $params = array_merge($params, $where);
        return $this->execute($sql, $params);
    }

    /**
     * @param string $table
     * @param array $params
     * @param array $where
     * @param int|null $limit
     * @return bool|PDOStatement
     */
    public function select(string $table, array $params = [], array $where = [], int $limit = null)
    {
        $sql = $this->prepareSelect($table, $params, $where, $limit);

        return $this->execute($sql, $where);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function row(string $sql, array $params = [])
    {
        $result = $this->execute($sql, $params);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function rows(string $sql, array $params = []): array
    {
        $result = $this->execute($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function col(string $sql, array $params = [])
    {
        $result = $this->execute($sql, $params);
        return $result->fetchColumn();
    }

    /**
     * @param string $table
     * @param string $col
     * @param array $where
     * @return mixed
     */
    public function selectCol(string $table, string $col, array $where = [])
    {
        $where_string = $this->prepareWhere($where);
        $sql = "SELECT $col FROM $table";
        if (!empty($where_string)) {
            $sql .= " WHERE $where_string";
        }
        $sql .= ' LIMIT 1';
        return $this->col($sql, $where);
    }

    /**
     * @param string $table
     * @param array $params
     * @param array $where
     * @return mixed
     */
    public function selectRow(string $table, array $params = [], array $where = [])
    {
        $sql = $this->prepareSelect($table, $params, $where, 1);

        return $this->row($sql, $where);
    }

    /**
     * @param string $table
     * @param array $params
     * @param array $where
     * @param int $limit
     * @return array
     */
    public function selectRows(string $table, array $params = [], array $where = [], int $limit = null): array
    {
        $sql = $this->prepareSelect($table, $params, $where, $limit);

        return $this->rows($sql, $where);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool|PDOStatement
     */
    public function execute(string $sql, array $params = [])
    {
        $result = $this->db->prepare($sql);
        $count = count($params);

        for ($i = 0; ($i + 1) < $count; ++$i) {
            $result->bindParam(':' . $params[$i], $params[++$i]);
        }
        $result->execute();

        return $result;
    }

    /**
     * @param array $where
     * @return string
     */
    private function prepareWhere(array &$where): string
    {
        $where_string = '';
        $count = count($where);

        for ($i = 0; ($i + 1) < $count; $i += 2) {
            $key = $where[$i];
            $where_string .= "$key = :w$key AND ";
            $where[$i] = "w$key";
        }
        $where_string = rtrim($where_string, ' AND ');

        return $where_string;
    }

    /**
     * @param string $table
     * @param array $params
     * @param array $where
     * @param int $limit
     * @return string
     */
    private function prepareSelect(string $table, array &$params, array &$where, ?int $limit): string
    {
        $params_string = '';
        $where_string = $this->prepareWhere($where);

        foreach ($params as $param) {
            $params_string .= "$param,";
        }
        $params_string = rtrim($params_string, ',');
        $sql = 'SELECT';
        $sql .= (empty($params_string) ? ' *' : " $params_string");
        $sql .= " FROM $table";
        if (!empty($where_string)) {
            $sql .= " WHERE $where_string";
        }
        if ($limit) {
            $sql .= " LIMIT $limit";
        }

        return $sql;
    }
}
