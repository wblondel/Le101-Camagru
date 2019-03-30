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
        $this->loadModel('Image');
    }

    /**
     * @param string $username
     */
    public function show(string $username)
    {
        $logged = $this->logged;

        $user = $this->User->findbyUsername($username);

        if ($user === false) {
            $this->notFound();
        }

        $images = $this->Image->lastByUserId(intval($user->id));

        $res = [
            'js' => ['progressive-image.js'],
            'css' => ['gallery.css', 'progressive-image.css']
        ];

        $this->render('users.show', compact('user', 'logged', 'res', 'images'));
    }
}
