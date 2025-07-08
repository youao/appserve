<?php

namespace serve\admin\models;

use common\baseModel;
use common\utils\Db;

class Groups extends baseModel
{
    public $table = 'groups';
    public $table_columns = [
        'id' => [
            'i' => '1',
            'type' => 'int(10) unsigned',
            'primary' => 1,
        ],
        'name' => [
            'i' => '2',
            'type' => 'varchar(50)',
            'comment' => '字段'
        ],
        'title' => [
            'i' => '3',
            'type' => 'varchar(50)',
            'comment' => '名称'
        ],
        'description' => [
            'i' => '4',
            'type' => 'varchar(255)',
            'null' => 1,
            'comment' => '介绍'
        ],
        'sort' => [
            'i' => '5',
            'type' => 'tinyint(3) unsigned',
            'default' => 0
        ],
        'add_time' => [
            'i' => '6',
            'type' => 'datetime'
        ],
        'update_time' => [
            'i' => '7',
            'type' => 'datetime'
        ]
    ];

    public $create_fields = ['name', 'title'];
    public $read_fields = ['id', 'name', 'title'];
    public $update_fields = ['id', 'name', 'title'];
    public $delete_fields = ['id'];
}
