<?php

header('Access-Control-Allow-Origin:http://localhost:8181');
header('Access-Control-Allow-Headers:X-Auth-Token');
header('Access-Control-Allow-Methods:*');

include 'utils/request.php';

$path = $_SERVER['PATH_INFO'];
$query = $_SERVER['QUERY_STRING'];

$paths = explode("/", $path);

$mod = $paths[1];
$act = $paths[2];

if (empty($mod) || empty($act)) {
    exit(requestResult('缺少环境参数'));
}

include 'api/' . $mod . '/' . $act . '.php';
