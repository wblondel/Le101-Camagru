<?php declare(strict_types=1);

namespace App\Controller;

use App;
use Core\Auth\DBAuth;
use Core\Email\Email;
use Core\HTML\BootstrapForm;
use Core\String\Str;
use Core\Validator\Validator;

/**
 * Class AccountsController
 *
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
                // Build POST request:
                $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
                $recaptchaSecret = "SECRET_KEY";
                $recaptchaResponse = $_POST['recaptcha_response'];

                // Make and decode POST request:
                $recaptcha = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
                $recaptcha = json_decode($recaptcha);

                // Take action based on the score returned:
                if ($recaptcha->score >= 0.1) {
                    $validator = new Validator($_POST);

                    if ($validator->isConfirmed('password', _("The passwords do not match."))) {
                        if ($validator->isAlphaNum('username', _("Your username should contain letters and numbers only."))) {
                            $validator->isUnique('username', $db, 'users', _("This username is already taken."));
                        }
                        if ($validator->isEmail('email', _("Your email isn't valid."))) {
                            $validator->isUnique('email', $db, 'users', _("This email is already taken."));
                        }
                        $validator->isPasswordStrong('password', _("The password you chose isn't strong enough."));
                    }

                    if ($validator->isValid()) {
                        $token = Str::random(60);
                        $userId = $auth->register($_POST['username'], $_POST['password'], $_POST['email'], $token);
                        if ($userId) {
                            $mailer = Email::make()
                                ->setTo($_POST['email'], $_POST['username'])
                                ->setFrom('contact@camagru.fr', 'Camagru.fr')
                                ->setSubject(_("Welcome to Camagru - Confirm your account"))
                                ->setMessage('<strong>' .
                                    _("To confirm your account, please click on this link:") .
                                    '</strong><br><a href="https://camagru.fr/accounts/confirm/' . $userId .
                                    '/' . $token . '">' . _("Confirm my account") . '</a>')
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
                } else {
                    $this->forbidden();
                }
            }

            $form = new BootstrapForm($_POST);

            $this->render(
                'accounts.register',
                compact('form', 'errors'),
                _("Create an account"),
                ['js' => ['login-register.js'], 'css' => ['login-register.css']]
            );
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

        if ($this->logged === false) {
            if (!empty($_POST)) {
                // Build POST request:
                $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
                $recaptchaSecret = "SECRET_KEY";
                $recaptchaResponse = $_POST['recaptcha_response'];

                // Make and decode POST request:
                $recaptcha = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
                $recaptcha = json_decode($recaptcha);

                // Take action based on the score returned:
                if ($recaptcha->score >= 0.1) {
                    if ($auth->login($_POST['username'], $_POST['password'], isset($_POST['remember']))) {
                        $session->setFlash('success', _("You are now logged in."));
                        $this->redirect();
                    } else {
                        $session->setFlash('danger', _("Invalid credentials."));
                    }
                } else {
                    $this->forbidden();
                }
            }

            $form = new BootstrapForm($_POST);

            $this->render(
                'accounts.login',
                compact('form'),
                _("Log in"),
                ['js' => ['login-register.js'], 'css' => ['login-register.css']]
            );
        } else {
            $session->setFlash('success', _("You're already logged in."));
            $this->redirect();
        }
    }

    /**
     * @param int $userId
     * @param string $token
     */
    public function confirm(int $userId, string $token)
    {
        $session = App::getInstance()->getSession();
        $auth = new DBAuth(App::getInstance()->getDb(), $session);

        if ($this->logged === false) {
            if ($auth->confirm(strval($userId), $token)) {
                $session->setFlash('success', _("Your account is now activated. You can log in."));
                $this->redirect('accounts', 'login');
            } else {
                $session->setFlash('danger', _("We couldn't activate your account."));
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
                // Build POST request:
                $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
                $recaptchaSecret = "SECRET_KEY";
                $recaptchaResponse = $_POST['recaptcha_response'];

                // Make and decode POST request:
                $recaptcha = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
                $recaptcha = json_decode($recaptcha);

                // Take action based on the score returned:
                if ($recaptcha->score >= 0.1) {
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
                                ->setMessage('<strong>' .
                                    _("To reset your password, please click on this link:") .
                                    '</strong><br><a href="https://camagru.fr/accounts/reset/?id=' . $user->id .
                                    '&token=' . $token . '">' . _("Reset my password") . '</a>')
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
                } else {
                    $this->forbidden();
                }
            }

            $form = new BootstrapForm($_POST);

            $this->render(
                'accounts.forgot',
                compact('form', 'errors'),
                _("Reset your password"),
                ['js' => ['login-register.js'], 'css' => ['login-register.css']]
            );
        } else {
            $this->redirect();
        }
    }

    /**
     * @param int $userId
     * @param string $token
     */
    public function reset(int $userId, string $token)
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);

        if ($this->logged === false) {
            $user = $auth->checkPasswordResetToken(strval($userId), $token);
            if ($user) {
                if (!empty($_POST)) {
                    // Build POST request:
                    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
                    $recaptchaSecret = "SECRET_KEY";
                    $recaptchaResponse = $_POST['recaptcha_response'];

                    // Make and decode POST request:
                    $recaptcha = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
                    $recaptcha = json_decode($recaptcha);

                    // Take action based on the score returned:
                    if ($recaptcha->score >= 0.1) {
                        $validator = new Validator($_POST);

                        if ($validator->isConfirmed('password', _("The passwords do not match."))) {
                            $validator->isPasswordStrong('password', _("The password you chose isn't strong enough."));
                        }

                        if ($validator->isValid()) {
                            $password = $auth->hashPassword($_POST['password']);
                            $auth->resetPassword(strval($userId), $password);
                            $session->setFlash('success', _("Your password has been modified. Please log in."));
                            $this->redirect('accounts', 'login');
                        } else {
                            $errors = $validator->getErrors();
                        }
                    } else {
                        $this->forbidden();
                    }
                }

                $form = new BootstrapForm($_POST);

                $this->render(
                    'accounts.reset',
                    compact('form', 'errors'),
                    _("Set your new password"),
                    ['js' => ['login-register.js'], 'css' => ['login-register.css']]
                );
            } else {
                $session->setFlash('danger', _("Invalid token."));
                $this->redirect();
            }
        } else {
            $this->redirect();
        }
    }

    public function edit()
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);
        $auth->restrict();

        $userId = $session->read('auth');
        $userInfo = $this->User->find($userId);

        if (!empty($_POST)) {
            // Build POST request:
            $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptchaSecret = "SECRET_KEY";
            $recaptchaResponse = $_POST['recaptcha_response'];

            // Make and decode POST request:
            $recaptcha = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
            $recaptcha = json_decode($recaptcha);

            // Take action based on the score returned:
            if ($recaptcha->score >= 0.1) {
                $validator = new Validator($_POST);

                /*
                if ($validator->isConfirmed('password', _("The passwords do not match."))) {
                    if ($validator->isAlphaNum('username', _("Your username should contain letters and numbers only."))) {
                        $validator->isUnique('username', $db, 'users', _("This username is already taken."));
                    }
                    if ($validator->isEmail('email', _("Your email isn't valid."))) {
                        $validator->isUnique('email', $db, 'users', _("This email is already taken."));
                    }
                    $validator->isPasswordStrong('password', _("The password you chose isn't strong enough."));
                }
                */

                if ($validator->isValid()) {
                    if ($userId) {
                        // c'est bon
                        $this->redirect();
                    } else {
                        $session->setFlash('danger', _("Error while changing preferencess."));
                    }
                } else {
                    $errors = $validator->getErrors();
                }
            } else {
                $this->forbidden();
            }
        }

        $form = new BootstrapForm($_POST);

        $this->render(
            'accounts.edit',
            compact('form', 'errors'),
            _("Edit Profile"),
            ['js' => ['login-register.js'], 'css' => ['login-register.css']]
        );
    }
}
