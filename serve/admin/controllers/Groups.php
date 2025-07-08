<?php

namespace serve\admin\controllers;

use serve\admin\models\Groups as GroupsModel;

class Groups
{
    function list()
    { 
        $model = new GroupsModel();
        $exist = $model->existTable();
        if ($exist) {
            echo json_encode($model->getTableColumns());
        } else {
            echo $model->createTable();
        }
    }

    function check()
    { 
        $model = new GroupsModel();
        $exist = $model->existTable();
        if ($exist) {
            echo json_encode($model->getTableColumns());
        } else {
            echo $model->createTable();
        }
    }
}
