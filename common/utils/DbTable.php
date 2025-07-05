<?php

namespace common\utils;

use common\utils\Db;

class DbTable
{
    public $name;
    public $db;

    function __construct($name)
    {
        $this->name = $name;
        $this->db = new Db();
    }

    function exist()
    {
        $sql = "SHOW COLUMNS FROM `$this->name`";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    function getColumns()
    {
        $dbname = $this->db->name;
        $sql = "SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_COMMENT 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$this->name'";
        $result = $this->db->query($sql);
        $arr = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
        }
        return $arr;
    }
}
