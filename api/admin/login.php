<?php

$table = "admin_user";

$postData = getAxiosPostData();

$account = $postData['account'];
if (empty($account)) {
    $res['status'] = 0;
    $res['msg'] = '请先输入账号';
    $res = json_encode($res);
    exit($res);
}

$password = $postData['password'];
if (empty($password)) {
    $res['status'] = 0;
    $res['msg'] = '请先输入密码';
    $res = json_encode($res);
    exit($res);
}

$row = findOneByAccount($table, $account);

if (count($row) == 0) {
    $res['status'] = 0;
    $res['msg'] = '该账号未注册';
    $res = json_encode($res);
    exit($res);
}

if($row['password'] != $password) {
    $res['status'] = 0;
    $res['msg'] = '账号或密码错误';
    $res = json_encode($res);
    exit($res);
}

$data['userInfo'] = $row;
$data['token'] = 'token';
$res['status'] = 1;
$res['data'] = $data;
$res['msg'] = '登录成功';
$res = json_encode($res);
exit($res);

function findOneByAccount($table, $account)
{
    $conn = dbConn();

    $sql = "SELECT * FROM $table WHERE account='$account' LIMIT 1";
    $result = $conn->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
    }
    if (!isset($row)) {
        $row = array();
    }

    return $row;

    $conn->close();
}
