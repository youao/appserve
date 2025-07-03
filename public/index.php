<?php
define('PUBLIC_DIR', __DIR__);
define('ROOT_DIR', dirname(PUBLIC_DIR));
define('SERVE_DIR', ROOT_DIR . '\serve');

spl_autoload_register(function ($name) {
    include_once(SERVE_DIR . '/' . $name . '.php');
});

include SERVE_DIR . "/common/route.php";
include SERVE_DIR . "/app/routers/index.php";

$uri = $_SERVER['REQUEST_URI'];
$route_path = strpos($uri, '?') ? explode("?", $uri)[0] : $uri;
$route = $routers[$route_path];
if (empty($route)) {
    header("HTTP/1.1 404");
    header("Status: 404");
    exit();
}
$className = $route[0];
$obj = new $className();
$actionName = $route[1];
call_user_func([$obj, $actionName]);
