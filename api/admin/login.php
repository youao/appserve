<?php

$table = "admin_user";

$postData = getAxiosPostData();

$account = $postData['account'];
if (empty($account)) {
    exit(requestResult('请先输入账号'));
}

$password = $postData['password'];
if (empty($password)) {
    exit(requestResult('请先输入密码'));
}

$row = findOneByAccount($table, $account);

if (count($row) == 0) {
    exit(requestResult('该账号未注册'));
}

if ($row['password'] != $password) {
    exit(requestResult('账号或密码错误'));
}

$token = encrypt($account . $password);
if (!$token) {
    exit(requestResult('创建TOKEN失败'));
}

$data = array('userInfo' => $row, 'token' => $token);
$res = array('status' => 1, 'data' => $data, 'msg' => '登录成功');
exit(requestResult($res));

function findOneByAccount($table, $account)
{
    $sql = "SELECT * FROM $table WHERE account='$account' LIMIT 1";
    return dbSelect($sql);
}
