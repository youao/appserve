<?php
include 'utils/db.php';
include 'utils/aes.php';

/**
 * 获取token
 */
function getXAuthToken() {
    $headers = getallheaders();
    return $headers['X-Auth-Token'];
}

/**
 * 获取token加密的id
 */
function getTokenId($env) {
    $token = getXAuthToken();
    $data = urlstrToArray($token);
    if (empty($data['env'] || $data['env'] !== $env)) {
        exit(requestResult('token错误'));
    }
    return $data['id'];
}

/**
 * 获取axios提交的post数据
 */
function getAxiosPostData()
{
    $content = file_get_contents('php://input');
    if (empty($content)) {
        return false;
    }
        
    return urlstrToArray($content);
}

function urlstrToArray($str) {
    $str = explode('&', $str);
    for ($i = 0; $i < count($str); $i++) {
        $arr = explode('=', $str[$i]);
        $data[$arr[0]] = urldecode($arr[1]);
    }
    return $data;
}

/**
 * 获取axios提交的post数据
 */
function requestResult($ops)
{
    if (is_string($ops)) {
        $msg = $ops;
    } elseif (is_array($ops)) {
        return json_encode($ops);
    }
    $res['status'] = isset($status) ? $status : 0;
    if (isset($msg)) {
        $res['msg'] = $msg;
    }
    if (isset($data)) {
        $res['data'] = $data;
    }
    return json_encode($res);
}
