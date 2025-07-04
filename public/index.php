<?php
define('ROOT_DIR', dirname(__DIR__));

include_once ROOT_DIR . "/serve/common/config.php";
include_once ROOT_DIR . "/serve/common/index.php";

spl_autoload_register(function ($name) {
    $path = ROOT_DIR . '\\' . $name . '.php';
    if (!file_exists($path)) {
        // exit(setStatus(404));
    }
    include_once(ROOT_DIR . '\\' . $name . '.php');
});

startServer();
