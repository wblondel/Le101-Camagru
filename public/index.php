<?php declare(strict_types=1);

use Core\Router;

define('ROOT', dirname(__DIR__));

# We load our App
require ROOT . '/app/App.php';
App::load();


// ==========
// = locale =
// ==========

// TODO: Move this part in a core class
// I have to find how to do this.

$default_lang = "fr_FR.utf8";

// here we define the global system locale given the found language
putenv("LANG=" . $default_lang);

// this might be useful for date functions (LC_TIME) or money formatting (LC_MONETARY), for instance
setlocale(LC_ALL, $default_lang);

// this will make Gettext look for /locales/<lang>/LC_MESSAGES/main.mo
bindtextdomain('main', ROOT . '/locales');

// indicates in what encoding the file should be read
bind_textdomain_codeset('main', 'UTF-8');

// here we indicate the default domain the gettext() calls will respond to
textdomain('main');

// ==========
// = router =
// ==========

if (!isset($_GET['url'])) {
    $_GET['url'] = '/';
}

$router = new Router\Router($_GET['url']);
$router->get('/', "Images#index");
$router->get('/images/:id', "Images#show")->with('id', '[0-9]+');
$router->get('/images/new', "Images#new");
$router->get('/images/tag/:id', "Images#tag")->with('id', '[0-9]+');

$router->get('/users/register', "Users#register");
$router->get('/users/login', "Users#login");
$router->get('/users/confirm', "Users#confirm");
$router->get('/users/logout', "Users#logout");
$router->get('/users/forgot', "Users#forgot");
$router->get('/users/reset', "Users#reset");

$router->run();