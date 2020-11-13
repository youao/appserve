<?php

$table = "admin_user";

$postData = getAxiosPostData();

$id = getTokenId('youch');

$row = findOneById($table, $id);

$res = array('status' => 1, 'data' => $row, 'msg' => '获取成功');

exit(requestResult($res));

function findOneById($table, $id)
{
    $sql = "SELECT * FROM $table WHERE id=$id";
    return dbSelect($sql);
}
