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
}
