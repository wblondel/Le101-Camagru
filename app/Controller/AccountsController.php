<?php declare(strict_types=1);

namespace App\Controller;

use Core\Auth\DBAuth;
use Core\HTML\BootstrapForm;
use Core\Email\Email;
use \App;
use Core\String\Str;
use Core\Validator\Validator;

/**
 * Class AccountsController
 * @package App\Controller
 */
class AccountsController extends AppController
{
    protected $template = "card-form";

    /**
     * Register a user.
     */
    public function register()
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);

        if ($this->logged === false) {
            if (!empty($_POST)) {
                $validator = new Validator($_POST);

                if ($validator->isAlphaNum('username', _("Your username should contain letters and numbers only."))) {
                    $validator->isUnique('username', $db, 'users', _("This username is already taken."));
                }
                if ($validator->isEmail('email', _("Your email isn't valid."))) {
                    $validator->isUnique('email', $db, 'users', _("This email is already taken."));
                }

                if ($validator->isValid()) {
                    $token = Str::random(60);
                    $user_id = $auth->register($_POST['username'], $_POST['password'], $_POST['email'], $token);
                    if ($user_id) {
                        $mailer = Email::make()
                            ->setTo($_POST['email'], $_POST['username'])
                            ->setFrom('contact@camagru.fr', 'Camagru.fr')
                            ->setSubject(_("Welcome to Camagru - Confirm your account"))
                            ->setMessage('<strong>'.
                                _("To confirm your account, please click on this link:").
                                '</strong><br><a href="https://camagru.fr/accounts/confirm/?id='.$user_id.
                                '&token='.$token.'">' . _("Confirm my account") . '</a>')
                            ->setReplyTo('contact@camagru.fr')
                            ->setHtml()
                            ->send();
                        if ($mailer) {
                            $session->setFlash('success', _("Please check your emails to activate your account."));
                        } else {
                            $session->setFlash('error', _("You've been registered, but the confirmation email couldn't be sent.\nPlease contact the administrators."));
                        }
                        $this->redirect();
                    } else {
                        $session->setFlash('danger', _("Error while registering."));
                    }
                } else {
                    $errors = $validator->getErrors();
                }
            }
            $form = new BootstrapForm($_POST);

            $res = [
                'js' => ['login-register.js'],
                'css' => ['login-register.css']
            ];

            $page_title = _("Create an account");
            $this->render('accounts.register', compact('page_title','form', 'errors', 'res'));
        } else {
            $session->setFlash('success', _("You're already logged in."));
            $this->redirect();
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
                    $session->setFlash('success', _("You are now logged in."));
                    $this->redirect();
                } else {
                    $session->setFlash('danger', _("Invalid credentials."));
                }
            }

            $form = new BootstrapForm($_POST);

            $res = [
                'js' => ['login-register.js'],
                'css' => ['login-register.css']
            ];

            $page_title = _("Log in");
            $this->render('accounts.login', compact('page_title', 'form', 'res'));
        } else {
            $session->setFlash('success', _("You're already logged in."));
            $this->redirect();
        }
    }

    public function confirm()
    {
        $session = App::getInstance()->getSession();
        $auth = new DBAuth(App::getInstance()->getDb(), $session);

        if ($this->logged  === false) {
            if (isset($_GET['id']) && ctype_digit($_GET['id']) && isset($_GET['token']) && !empty($_GET['token'])) {
                if ($auth->confirm($_GET['id'], $_GET['token'])) {
                    $session->setFlash('success', _("Your account is now activated. You can log in."));
                    $this->redirect('accounts', 'login');
                } else {
                    $session->setFlash('danger', _("We couldn't activate your account."));
                }
            } else {
                $this->badRequest();
            }
        } else {
            $session->setFlash('success', _("You're already logged in."));
        }
        $this->redirect();
    }

    /**
     * Log out the user.
     */
    public function logout()
    {
        $auth = new DBAuth(App::getInstance()->getDb(), App::getInstance()->getSession());
        $auth->restrict();

        $auth->logout();
        App::getInstance()->getSession()->setFlash('success', _("You're now logged out."));
        $this->redirect();
    }

    public function forgot()
    {
        $session = App::getInstance()->getSession();
        $auth = new DBAuth(App::getInstance()->getDb(), $session);

        if ($this->logged === false) {
            if (!empty($_POST)) {
                $validator = new Validator($_POST);

                $validator->isEmail('email', _("Your email isn't valid."));

                if ($validator->isValid()) {
                    $token = Str::random(60);
                    $user = $auth->setResetPasswordToken($_POST['email'], $token);

                    if ($user) {
                        $mailer = Email::make()
                            ->setTo($user->email, $user->username)
                            ->setFrom('contact@camagru.fr', 'Camagru.fr')
                            ->setSubject(_("Camagru - Reset your password"))
                            ->setMessage('<strong>'.
                                _("To reset your password, please click on this link:").
                                '</strong><br><a href="https://camagru.fr/accounts/reset/?id='.$user->id.
                                '&token='.$token.'">' . _("Reset my password") . '</a>')
                            ->setReplyTo('contact@camagru.fr')
                            ->setHtml()
                            ->send();
                        if ($mailer) {
                            $session->setFlash('success', _("Please check your inbox for an email we just sent you with instructions for how to reset your password and log into your account."));
                            $this->redirect();
                        } else {
                            $session->setFlash('danger', _("The reset instructions couldn't be sent.\nPlease contact the administrators."));
                        }
                    } else {
                        $session->setFlash('danger', _("This email doesn't match any registered account."));
                    }
                } else {
                    $errors = $validator->getErrors();
                }

            }

            $form = new BootstrapForm($_POST);

            $res = [
                'js' => ['login-register.js'],
                'css' => ['login-register.css']
            ];

            $page_title = _("Reset your password");
            $this->render('accounts.forgot', compact('page_title', 'form', 'errors', 'res'));
        } else {
            $this->redirect();
        }
    }

    public function reset()
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);

        if ($this->logged === false) {
            if (isset($_GET['id']) && ctype_digit($_GET['id']) && isset($_GET['token']) && !empty($_GET['token'])) {
                $user = $auth->checkPasswordResetToken($_GET['id'], $_GET['token']);
                if ($user) {
                    if (!empty($_POST)) {
                        $validator = new Validator($_POST);

                        $validator->isConfirmed('password');

                        if ($validator->isValid()) {
                            $password = $auth->hashPassword($_POST['password']);
                            $auth->resetPassword($_GET['id'], $password);
                            $session->setFlash('success', _("Your password has been modified. Please log in."));
                            $this->redirect('accounts', 'login');
                        } else {
                            $errors = $validator->getErrors();
                        }
                    }

                    $form = new BootstrapForm($_POST);

                    $res = [
                        'js' => ['login-register.js'],
                        'css' => ['login-register.css']
                    ];

                    $page_title = _("Set your new password");
                    $this->render('accounts.reset', compact('page_title', 'form', 'errors', 'res'));
                } else {
                    $session->setFlash('danger', _("Invalid token."));
                    $this->redirect();
                }
            } else {
                $this->badRequest();
            }
        } else {
            $this->redirect();
        }
    }
}
