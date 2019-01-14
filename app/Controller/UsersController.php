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
class UsersController extends AppController
{
    protected $template = 'gallery';

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
    }

    public function show($id)
    {
        $logged = $this->logged;

        $user = $this->User->find(intval($id));

        if ($user === false) {
            $this->notFound();
        }

        $res = [
            'js' => ['progressive-image.js'],
            'css' => ['gallery.css', 'progressive-image.css']
        ];

        $this->render('users.show', compact('user', 'logged', 'res'));
    }
}
