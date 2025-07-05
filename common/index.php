<?php

function resource($path)
{
    return '\\statics\\' . $path;
}

function css($path)
{
    return resource('styles\\' . $path . '.css');
}

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
    global $config;
    $path = strpos($url, '?') ? explode("?", $url)[0] : $url;
    $run = getServeName($path);
    $config['run'] = $run;
    $route = getRouteController($path);
    $className = '\\serve\\' . $run . '\\routers\\' . $route[0];
    return callClassFun($className, $route[1]);
}

function getServeName($path)
{
    global $config;
    $default_serve = $config['run'];
    if (empty($path) || $path === '/') return $default_serve;
    $array = explode("/", $path);
    if (empty($array[0])) {
        $array = array_splice($array, 1);
    }
    return empty($config['serves'][$array[0]]) ?  $default_serve : $array[0];
}

function getRouteController($path)
{
    global $config;
    if (empty($path) || $path === '/') return ['Index'];
    $array = explode("/", $path);
    if (empty($array[0])) {
        $array = array_splice($array, 1);
    }
    if ($array[0] === $config['run']) {
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
    if (!empty($data)) {
        extract($data); // 将数组键名作为变量名
    }
    ob_start(); // 开启输出缓冲
    include $template; // 包含模板文件
    return ob_get_clean(); // 获取并清空输出缓冲区的内容
}

function viewRender($template, $data)
{
    global $config;
    $path = ROOT_DIR . '\\serve\\' . $config['run'] . '\\views\\' . $template . '.tpl.php';
    return render($path, $data);
}


/**
 * @param $options['base']
 * @param $options['title']
 * @param $options['path']
 * @param $options['data']
 * @param $options['content']
 * @param $options['content'][]['path']
 * @param $options['content'][]['data']
 */
function tpl($options)
{
    global $config;
    $defaul_title = $config['serves'][$config['run']]['title'];
    $default_options = [
        'base' => 'base',
        'title' => $defaul_title,
    ];
    $options = array_merge($default_options, $options);
    $content = getTplContent($options);

    echo viewRender($options['base'], [
        'title' => $options['title'],
        'content' => $content
    ]);
}

function getTplContent($options)
{
    if (empty($options)) return '';
    if (is_string($options)) return $options;
    if (empty($options['content'])) {
        if (empty($options['path'])) return '';
        return viewRender($options['path'], $options['data']);
    }
    if (is_string($options['content'])) return $options['content'];
    if (is_array($options['content'])) {
        $content = '';
        foreach ($options['content'] as $val) {
            $content .= getTplContent($val);
        }
        return $content;
    }
    return '';
}
