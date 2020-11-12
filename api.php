<?php

header('Access-Control-Allow-Origin:http://localhost:8181');

include 'db.php';

$path = $_SERVER['PATH_INFO'];
$query = $_SERVER['QUERY_STRING'];

$paths = explode("/", $path);

$mod = $paths[1];
$act = $paths[2];

if (empty($mod) || empty($act)) {
    $res['status'] = 0;
    $res['msg'] = '缺少环境参数';
    $res = json_encode($res);
    exit($res);
}

include 'api/' . $mod . '/' . $act . '.php';
