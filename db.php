<?php
$DB['servername'] = "localhost";
$DB['username'] = "admin";
$DB['password'] = "123456";
$DB['dbname'] = "youch";

$Token['key'] = 'dbc4e89f2531e267c5230a85574450d2'; // md5('youch')
$Token['method'] = 'AES-128-EC';

function dbConn()
{
    global $DB;
    $conn = new mysqli($DB['servername'], $DB['username'], $DB['password'], $DB['dbname']);
    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    return $conn;
}

/**
 * 加密
 * @param string $str    要加密的数据
 * @return bool|string   加密后的数据
 */
function encrypt($str)
{
    global $Token;
    $data = openssl_encrypt($str, $Token['method'], $Token['key'], OPENSSL_RAW_DATA);
    $data = base64_encode($data);

    return $data;
}

/**
 * 解密
 * @param string $str    要解密的数据
 * @return string        解密后的数据
 */
function decrypt($str)
{
    global $Token;
    $decrypted = openssl_decrypt(base64_decode($str), $Token['method'], $Token['key'], OPENSSL_RAW_DATA);
    return $decrypted;
}

/**
 * 获取axios提交的post数据
 */
function getAxiosPostData()
{
    $content = file_get_contents('php://input');
    $data = array();
    if (empty($content)) {
        return $data;
    }

    $content = explode('&', $content);

    for ($i = 0; $i < count($content); $i++) {
        $arr = explode('=', $content[$i]);
        $data[$arr[0]] = $arr[1];
    }

    return $data;
}
