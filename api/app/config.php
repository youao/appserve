<?php

$table = "app_config";
$id = 1;

getTokenId('youch');

$postData = getAxiosPostData();
if (!$postData) {
    getAppConfig($table, $id);
} else {
    updateAppConfig($table, $id, $postData);
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

function updateAppConfig($table, $id, $postData)
{
    $name = $postData["name"];
    $logo = $postData["logo"];

    $sql = "UPDATE $table SET name = '".$name."', logo='".$logo."' WHERE id=$id";

    $retval = ddUpdate($sql);

    if ($retval) {
        $res = array(
            "status" => 1,
            "msg" => "修改成功"
        );
        exit(requestResult($res));
    }
}
