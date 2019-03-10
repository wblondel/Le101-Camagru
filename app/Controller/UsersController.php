<?php declare(strict_types=1);

namespace App\Controller;

use App;

/**
 * Class AccountsController
 *
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

    /**
     * @param $id
     */
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
