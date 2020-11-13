<?php

$_file = $_FILES["file"];

$img_typs = array("image/gif", "image/jpeg", "image/jpg", "image/png");

$is_img = in_array($_file["type"], $img_typs);
if (!$is_img) {
    exit(requestResult('非图片文件'));
}

if ($_file["error"] > 0) {
    exit(requestResult($_file["error"]));
}

$file_name = "upload/" . time() . "_" . $_file["name"];

move_uploaded_file($_file["tmp_name"], $file_name);

$file_url = "http://" . $_SERVER['HTTP_HOST'] . '/' . $file_name;

$res = array(
    "status" => 1,
    "data" => $file_url,
    "msg" => "上传成功"
);
exit(requestResult($res));
