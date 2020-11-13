<?php

$table = "app_config";
$id = 1;

$postData = getAxiosPostData();
if (!$postData) {
    getAppConfig($table, $id);
} else {
    $name = $postData["name"];
    $logo = $postData["logo"];

    $conn = mysqli_connect('localhost', 'admin', '123456');
    mysqli_query($conn , "set names utf8");
    mysqli_select_db($conn, "youch");
    $sql = "UPDATE $table SET name = '".$name."', logo='".$logo."' WHERE id=$id";
    // $sql = "UPDATE $table SET name = '".$name."', logo='".$logo."' WHERE id=$id";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('无法更新数据: ' . mysqli_error($conn));
    }

    $res = array(
        "status" => 1,
        "msg" => "修改成功"
    );
    exit(requestResult($res));
    mysqli_close($conn);
}

function getAppConfig($table, $id)
{
    $sql = "SELECT * FROM $table WHERE id='$id'";
    $data = dbSelect($sql);

    $res = array(
        "status" => 1,
        "data" => $data
    );
    exit(requestResult($res));
}
