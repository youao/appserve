<?php

function setStatus($status)
{
    header("HTTP/1.1 " . $status);
    header("Status: " . $status);
}

function callClassFun($className, $funName)
{
    if (empty($className)) return false;
    $obj = new $className();
    $funName = empty($funName) ? 'index' : $funName;
    return call_user_func([$obj, $funName]);
}

function getRouteData($url)
{
    $path = strpos($url, '?') ? explode("?", $url)[0] : $url;
    $route = getRouteController($path);
    $className = '\\serve\\app\\routers\\' . $route[0];
    return callClassFun($className, $route[1]);
}

function getRouteController($path)
{
    if (empty($path) || $path === '/') return ['Index'];
    $array = explode("/", $path);
    if (empty($array[0])) {
        $array = array_splice($array, 1);
    }
    if (count($array) === 1) return [ucfirst($array[0])];
    $fun = array_pop($array);
    $name = array_pop($array);
    if (empty($array)) {
        return [ucfirst($name), $fun];
    }
    return [implode('\\', $array) . '\\' . ucfirst($name), $fun];
}


function startServer()
{
    $route = getRouteData($_SERVER['REQUEST_URI']);
    if (empty($route) || !is_array($route) || empty($route[0])) {
        exit(setStatus(404));
    }
    return callClassFun($route[0], $route[1]);
}
