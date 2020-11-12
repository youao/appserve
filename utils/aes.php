<?php

$Token['key'] = 'dbc4e89f2531e267c5230a85574450d2'; // md5('youch')
$Token['method'] = 'DES-ECB';

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