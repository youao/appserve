<?php
$servername = "localhost";
$username = "admin";
$password = "123456";
$dbname = "youch";

$token_key = 'dbc4e89f2531e267c5230a85574450d2'; // md5('youch')
$token_method = 'AES-128-ECB';

function dbConn()
{
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
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
    global $token_key, $token_method;
    $data = openssl_encrypt($str, $token_method, $token_key, OPENSSL_RAW_DATA);
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
    global $token_key, $token_method;
    $decrypted = openssl_decrypt(base64_decode($str), $token_method, $token_key, OPENSSL_RAW_DATA);
    return $decrypted;
}
