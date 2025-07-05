<?php

namespace serve\app\controllers;

class Test
{
    public function index()
    {
        $conn = new \mysqli('localhost', 'root', 'ygD2zLTH3ULiE4hT', 'localapp_com');
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        echo '连接成功';
        // // 创建数据表
        // $sql = "CREATE TABLE `groups` (
        //     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        //     `name` VARCHAR(20) NOT NULL,
        //     `description` VARCHAR(50),
        //     `sort` TINYINT,
        //     `add_time` DATETIME,
        //     `update_time` DATETIME
        // )";
        // if ($conn->query($sql) === TRUE) {
        //     echo "数据表 groups 创建成功";
        // } else {
        //     echo "创建数据表错误: " . $conn->error;
        // }

        // // 删除数据表
        // $sql = "DROP TABLE IF EXISTS `groups`";
        // if ($conn->query($sql) === TRUE) {
        //     echo "数据表 groups 删除成功";
        // } else {
        //     echo "删除数据表错误: " . $conn->error;
        // }

        // // 修改表 添加列
        // $sql = "ALTER TABLE `groups` ADD `fields` TEXT";
        // if ($conn->query($sql) === TRUE) {
        //     echo "添加列成功";
        // } else {
        //     echo "修改表错误: " . $conn->error;
        // }

        // // 修改表 修改字段名
        // // MySQL 5.x
        // $sql = "ALTER TABLE `groups` CHANGE COLUMN `fields` `list` TEXT";
        // // MySQL 8.x
        // // $sql = "ALTER TABLE `groups` RENAME COLUMN fields TO list";
        // if ($conn->query($sql) === TRUE) {
        //     echo "重命名列成功";
        // } else {
        //     // echo "修改表错误: " . $conn->error;
        //     echo '<pre>';
        //     print_r($conn);
        // }

        // // 修改表 修改字段类型
        // $sql = "ALTER TABLE `groups` MODIFY COLUMN `description` VARCHAR(255) COMMENT '详细信息'";
        // if ($conn->query($sql) === TRUE) {
        //     echo "修改字段成功";
        // } else {
        //     echo "修改表错误: " . $conn->error;
        // }

        // // 修改表 删除列
        // $sql = "ALTER TABLE `groups` DROP COLUMN `list`";
        // if ($conn->query($sql) === TRUE) {
        //     echo "删除列成功";
        // } else {
        //     echo "修改表错误: " . $conn->error;
        // }

        // 查看表结构
        // $sql = "SHOW COLUMNS FROM `groups`";
        // $sql = "SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_COMMENT 
        // FROM INFORMATION_SCHEMA.COLUMNS 
        // WHERE TABLE_SCHEMA = 'localapp_com' AND TABLE_NAME = 'groups'";
        // $result = $conn->query($sql);
        // $arr = [];
        // if ($result->num_rows > 0) {
        //     while($row = $result->fetch_assoc()) {
        //         $arr[] = $row;
        //     }
        // }
        // echo '<pre>';
        // print_r($arr);
        // print_r($conn);
    }
}
