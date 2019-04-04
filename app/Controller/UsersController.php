<?php declare(strict_types=1);

namespace App\Controller;

use App;

/**
 * Class UsersController
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
        $user = $this->User->findbyUsername($username);

        if ($user === false) {
            $this->notFound();
        }

        $session = App::getInstance()->getSession();
        $connectedUserId = $session->read('auth');
        if (!$connectedUserId) {
            $connectedUserId = -1;
        }

        $images = $this->Image->lastByUserId(intval($connectedUserId), intval($user->id));

        $this->render(
            'users.show',
            compact('user', 'images'),
            null,
            ['js' => ['main.js', 'progressive-image.js', 'like.js'], 'css' => ['gallery.css', 'progressive-image.css']]
        );
    }
}
