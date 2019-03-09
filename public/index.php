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

# Images
$router->get('/', "Images#index");
$router->get('/i/:id', "Images#show")->with('id', '[0-9]+');
$router->get('/i/new', "Images#new");

# Tags
$router->get('/t/:id', "Images#tag")->with('id', '[0-9]+');

# Users
$router->get('/u/:id', 'Users#show');


# Accounts
$router->get('/accounts/register', "Accounts#register");
$router->post('/accounts/register', "Accounts#register");
$router->get('/accounts/login', "Accounts#login");
$router->post('/accounts/login', "Accounts#login");
$router->get('/accounts/confirm', "Accounts#confirm");
$router->get('/accounts/logout', "Accounts#logout");
$router->get('/accounts/forgot', "Accounts#forgot");
$router->post('/accounts/forgot', "Accounts#forgot");
$router->get('/accounts/reset', "Accounts#reset");
$router->post('/accounts/reset', "Accounts#reset");

# execute
$router->run();