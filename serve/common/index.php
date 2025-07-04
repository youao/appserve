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
    global $CONFIG;
    $path = strpos($url, '?') ? explode("?", $url)[0] : $url;
    $serve = getServeName($path);
    $CONFIG['run_serve'] = $serve;
    $route = getRouteController($path);
    $className = '\\serve\\' . $serve . '\\routers\\' . $route[0];
    return callClassFun($className, $route[1]);
}

function getServeName($path)
{
    global $CONFIG;
    $default_serve = $CONFIG['serve_names'][0];
    if (empty($path) || $path === '/') return $default_serve;
    $array = explode("/", $path);
    if (empty($array[0])) {
        $array = array_splice($array, 1);
    }
    return in_array($array[0], $CONFIG['serve_names']) ? $array[0] : $default_serve;
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
    if (empty($route) || empty($route[0])) {
        exit(setStatus(404));
    }
    return callClassFun($route[0], $route[1]);
}

function render($template, $data)
{
    extract($data); // 将数组键名作为变量名
    ob_start(); // 开启输出缓冲
    include $template; // 包含模板文件
    return ob_get_clean(); // 获取并清空输出缓冲区的内容
}

function viewtpl($template, $data)
{
    global $CONFIG;
    $serve = $CONFIG['run_serve'];
    $path = ROOT_DIR . '\\serve\\' . $serve . '\\views\\' . $template . '.tpl.php';
    return render($path, $data);
}
