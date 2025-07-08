<?php

namespace common;

use common\utils\Db;

class baseModel
{
    public $table = '';
    public $table_columns = [];

    public $create_fields = [];
    public $read_fields = ['id'];
    public $delete_fields = ['id'];
    public $update_fields = ['id'];

    function existTable()
    {
        $db = new Db();
        return $db->existTable($this->table);
    }

    function createTable()
    {
        $table = $this->table;
        $db = new Db();
        if ($db->existTable($table)) {
            return true;
        }
        $arr = [];
        foreach ($this->table_columns as $key => $value) {
            $type = $value['type'];
            $val = "'$key' $type";
            if (empty($value['null'])) {
                $val .= ' NOT NULL';
            }
            if ($value['primary'] === 1) {
                $val .= ' auto_increment PRIMARY KEY';
            }
            $default = $value['default'];
            if (!empty($default)) {
                if (is_string($default)) {
                    $val .= " DEFAULT '$default'";
                } else {
                    $val .= ' DEFAULT ' . $default;
                }
            }
            $i = $value['i'];
            $comment = $value['comment'];
            $val .= " COMMENT '$i?$comment'";
            $arr[] = $val;
        }
        return $db->createTable($table, implode(',', $arr));
    }

    function deleteTable()
    {
        $table = $this->table;
        $db = new Db();
        if (!$db->existTable($table)) {
            return true;
        }
        return $db->deleteTable($table);
    }

    function getTableColumns()
    {
        $table = $this->table;
        $db = new Db();
        if (!$db->existTable($table)) {
            return true;
        }
        return $db->getTableColumns($table);
    }

    function create($data) {

    }
}
