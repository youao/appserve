<?php

namespace serve\admin\controllers\sys;

use common\utils\DbTable as UtilDbTable;

class DbTable
{
    public function index()
    {
        $name = 'groups';
        $table = new UtilDbTable($name);
        $columns = [];
        if ($table->exist()) {
            $columns = $table->getColumns();
        }
        tpl([
            'title' => 'admin',
            'content' => [
                [
                    'path' => "sys/table",
                    'data' => [
                        'name' => $name,
                        'columns' => $columns
                    ]
                ]
            ]
        ]);
    }
}
