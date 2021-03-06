<?php declare(strict_types=1);

define('ROOT', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);

// We load our App
require ROOT . DS . 'app' . DS . 'App.php';
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
bindtextdomain('main', ROOT . DS . 'locales');

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

App::getInstance()->getRouter($_GET['url'])->run();
