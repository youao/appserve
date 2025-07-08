<?php

namespace common\utils;

class Db
{
    public $name;
    public $conn;

    function __construct()
    {
        global $config;
        $db = $config['db'];
        $this->name = $db['dbname'];
        $this->conn = new \mysqli(
            $db['servername'],
            $db['user'],
            $db['password'],
            $db['dbname']
        );
    }

    function query($sql)
    {
        if (empty($this->conn) || empty($sql)) {
            return false;
        }
        return $this->conn->query($sql);
    }

    function close()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    function existTable($table)
    {
        $sql = "SHOW COLUMNS FROM `$table`";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    function createTable($table, $columns)
    {
        $sql = "CREATE TABLE `$table` ($columns)";
        echo $sql;
        $result = $this->conn->query($sql);
        if ($result === true) {
            return true;
        }
        echo $this->conn->error;
        // return $this->conn->query($sql);
    }

    function deleteTable($table)
    {
        $sql = "DROP TABLE IF EXISTS `$table`";
        return $this->conn->query($sql);
    }

    function getTableColumns($table)
    {
        $dbname = $this->name;
        $sql = "SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_KEY, COLUMN_COMMENT 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table'";
        $result = $this->conn->query($sql);
        $arr = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
        }
        return $arr;
    }
}
