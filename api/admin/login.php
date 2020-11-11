<?php

$table = "admin_user";

// $account = isset($_POST['account']) ? $_POST["account"] : '';
// $password = isset($_POST['password']) ? $_POST["password"] : '';

$rws_post = $GLOBALS['HTTP_RAW_POST_DATA'];
$mypost = json_decode($rws_post);
$account = (string)$mypost->account;

$res['status'] = 0;
$res['msg'] = $account;
$res = json_encode($res);
exit($res);

if (empty($account)) {
    $res['status'] = 0;
    $res['msg'] = '请先输入账号';
    $res = json_encode($res);
    exit($res);
}

if (empty($password)) {
    $res['status'] = 0;
    $res['msg'] = '请先输入密码';
    $res = json_encode($res);
    exit($res);
}

$row = findOneByAccount($account);

$res['status'] = 1;
$res['data'] = $row;
$res = json_encode($res);
exit($res);

function findOneByAccount($account)
{
    global $table;
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
