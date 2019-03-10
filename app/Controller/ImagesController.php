<?php declare(strict_types=1);

namespace App\Controller;

use App;
use Core\Auth\DBAuth;

/**
 * Class DebugController
 *
 * @package App\Controller
 */
class ImagesController extends AppController
{
    protected $template = 'gallery';

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Image');
        $this->loadModel('Tag');
        $this->loadModel('User');
    }

    public function index()
    {
        $logged = $this->logged;

        //$images = $this->Image->lastWithTags();
        $images = $this->Image->last();

        $res = [
            'js' => ['progressive-image.js'],
            'css' => ['gallery.css', 'progressive-image.css']
        ];

        $this->render('images.index', compact('images', 'logged', 'res'));
    }

    public function new()
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);
        $auth->restrict();

        $this->template = 'default';

        $res = [
            'js' => ['camera.js'],
            'css' => ['camera.css']
        ];

        $page_title = _("Share a picture");
        $this->render('images.new', compact('page_title', 'res'));
    }

    /**
     * @param int $id
     */
    public function tag(int $id)
    {
        $logged = $this->logged;

        if (($tag = $this->Tag->find($id)) === false) {
            $this->notFound();
        }

        $images = $this->Image->lastByTag($id);

        $res = [
            'js' => ['progressive-image.js'],
            'css' => ['gallery.css', 'progressive-image.css']
        ];

        $this->render('images.tag', compact('images', 'tag', 'logged', 'res'));
    }

    /**
     * @param int $id
     */
    public function show(int $id)
    {
        $logged = $this->logged;

        $single_image = $this->Image->find($id);
        $user_info = $this->User->find(intval($single_image->users_id));

        if ($single_image === false) {
            $this->notFound();
        }

        $res = [
            'js' => ['progressive-image.js'],
            'css' => ['gallery.css', 'progressive-image.css']
        ];

        $this->render('images.show', compact('user_info', 'single_image', 'logged', 'res'));
    }
}
