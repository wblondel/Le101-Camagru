<?php
define('ROOT', dirname(__DIR__));

# We load our App
require ROOT . '/app/App.php';
App::load();

# URL parsing

$url = $_SERVER['REQUEST_URI'];
$urlPathParts = explode('/', ltrim(parse_url($url,  PHP_URL_PATH), '/'));

if (!array_key_exists(0, $urlPathParts) || empty($urlPathParts[0])) {
    $urlPathParts[0] = "images";
}

# Exit if we find any special characters in the page variable
if(preg_grep('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $urlPathParts)){
    header('HTTP/1.0 404 Not Found');
    die('404 Not Found (MOD_SECURITY_UNSAFE_URL)');
}

# Find the controller to load in the "Admin" controller group if page[0] is "admin"
# If admin only is defined, default controller:action is Posts:index
$arg = null;

if ($urlPathParts[0] == 'admin') {
    $controller = array_key_exists(1, $urlPathParts) ? '\App\Controller\Admin\\' . ucfirst($urlPathParts[1]) . 'Controller' : '\App\Controller\Admin\PostsController';
    $action = (array_key_exists(2, $urlPathParts) && !empty($urlPathParts[2])) ? $urlPathParts[2] : "index";
} else {
    $controller = '\App\Controller\\' . ucfirst($urlPathParts[0]) . 'Controller';
    if (array_key_exists(1, $urlPathParts) && preg_match('/\S/', $urlPathParts[1])){
        if (filter_var($urlPathParts[1], FILTER_VALIDATE_INT) === false) {
            $action = $urlPathParts[1];
            if (array_key_exists(2, $urlPathParts) && preg_match('/\S/', $urlPathParts[2])){
                if (filter_var($urlPathParts[2], FILTER_VALIDATE_INT) !== false) {
                    $arg = intval($urlPathParts[2]);
                }
            }
        } else {
            $action = "show";
            $arg = intval($urlPathParts[1]);
        }
    } else {
        $action = "index";
    }
}

if (class_exists($controller)) {
    $controller = new $controller();
    $controller->$action($arg);
} else {
    header('HTTP/1.0 404 Not Found');
    die('404 Not Found (CONTROLLER_NOT_FOUND)');
}