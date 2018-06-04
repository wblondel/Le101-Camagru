<?php
define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';
App::load();

if (isset($_GET['p']) && (!empty($_GET['p']))) {
    $page = $_GET['p'];
} else {
    $page = "posts.index";
}

$page = explode('.', $page);

if(preg_grep('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $page)){
    header('HTTP/1.0 404 Not Found');
    die('Page introuvable');
}

if ($page[0] == 'admin') {
    $controller = (isset($page[1])) ? '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller' : '\App\Controller\Admin\PostsController';
    $action = (isset($page[2])) ? $page[2] : "index";
} else {
    $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
    $action = (isset($page[1])) ? $page[1] : "index";
}

if (class_exists($controller)) {
    $controller = new $controller();
    $controller->$action();
} else {
    header('HTTP/1.0 404 Not Found');
    die('Page introuvable');
}