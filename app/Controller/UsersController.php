<?php declare(strict_types=1);

namespace App\Controller;

use Core\Auth\DBAuth;
use Core\HTML\BootstrapForm;
use \App;
use Core\String\Str;

/**
 * Class UsersController
 * @package App\Controller
 */
class UsersController extends AppController
{
    protected $template = "card-form";

    /**
     * Register a user.
     */
    public function register()
    {
        $session = App::getInstance()->getSession();
        $auth = new DBAuth(App::getInstance()->getDb(), $session);

        if ($this->logged === false) {
            if (!empty($_POST)) {
                $token = Str::random(60);
                $user_id = $auth->register($_POST['username'], $_POST['password'], $_POST['email'], $token);
                if ($user_id) {
                    mail(
                        $_POST['email'],
                        'Confirm your account',
                        "To confirm your account, please click on this link\n\n
                        https://camagru.2566335.xyz/?p=users.confirm&id=$user_id&token=$token"
                    );
                    $session->setFlash('success', 'Please check your emails to activate your account.');
                    header('Location: index.php');
                    exit();
                } else {
                    $session->setFlash('danger', "Error while registering.");
                }
            }
            $form = new BootstrapForm($_POST);
            $customcss = ["css/login-register.css"];
            $customjs = ["js/login-register.js"];
            $this->render('users.register', compact('form', 'customcss', 'customjs'));
        } else {
            $session->setFlash('success', "You're already connected.");
            header('Location: index.php');
            exit();
        }
    }

    /**
     * Log in the user.
     */
    public function login()
    {
        $session = App::getInstance()->getSession();
        $auth = new DBAuth(App::getInstance()->getDb(), $session);

        if ($this->logged  === false) {
            if (!empty($_POST)) {
                if ($auth->login($_POST['username'], $_POST['password'], isset($_POST['remember']))) {
                    $session->setFlash('success', "You're connected.");
                    header('Location: index.php');
                    exit();
                } else {
                    $session->setFlash('danger', "Invalid credentials.");
                }
            }

            $form = new BootstrapForm($_POST);
            $customcss = ["css/login-register.css"];
            $customjs = ["js/login-register.js"];
            $this->render('users.login', compact('form', 'customcss', 'customjs'));
        } else {
            $session->setFlash('success', "You're already connected.");
            header('Location: index.php');
            exit();
        }
    }

    public function confirm()
    {
        $session = App::getInstance()->getSession();
        $auth = new DBAuth(App::getInstance()->getDb(), $session);

        if ($this->logged  === false) {
            if (isset($_GET['id']) && ctype_digit($_GET['id']) && isset($_GET['token'])) {
                if ($auth->confirm($_GET['id'], $_GET['token'])) {
                    $session->setFlash('success', 'Your account is now activated. You can log in.');
                    header('Location: index.php?p=users.login');
                    exit();
                } else {
                    $session->setFlash('danger', "We couldn't activate your account.");
                }
            } else {
                $session->setFlash('danger', "We couldn't activate your account.");
            }
        } else {
            $session->setFlash('success', "You're already connected.");
        }
        header('Location: index.php');
        exit();
    }

    /**
     * Log out the user.
     */
    public function logout()
    {
        $auth = new DBAuth(App::getInstance()->getDb(), App::getInstance()->getSession());

        if ($this->logged  === true) {
            $auth->logout();
            App::getInstance()->getSession()->setFlash('success', "You're now logged out.");
        } else {
            App::getInstance()->getSession()->setFlash('danger', "You're not connected.");
        }
        header('Location: index.php');
        exit();
    }

    public function forgot()
    {
        if ($this->logged === false) {
            $form = new BootstrapForm($_POST);
            $customcss = ["css/login-register.css"];
            $customjs = ["js/login-register.js"];
            $this->render('users.forgot', compact('form', 'customcss', 'customjs'));
        } else {
            header('Location: index.php');
            exit();
        }
    }
}
