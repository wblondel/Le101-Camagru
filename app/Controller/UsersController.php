<?php declare(strict_types=1);

namespace App\Controller;

use Core\Auth\DBAuth;
use Core\HTML\BootstrapForm;
use \App;

/**
 * Class UsersController
 * @package App\Controller
 */
class UsersController extends AppController
{
    public function login()
    {
        $errors = false;

        if (!empty($_POST)) {
            $auth = new DBAuth(App::getInstance()->getDb(), App::getInstance()->getSession());
            if ($auth->login($_POST['username'], $_POST['password'])) {
                header('Location: index.php?p=admin.posts.index');
            } else {
                $errors = true;
            }
        }

        $form = new BootstrapForm($_POST);
        $this->render('users.login', compact('form', 'errors'));
    }
}
