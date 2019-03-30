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

        $logged = $this->logged;

        $this->template = 'default';

        $res = [
            'js' => ['camera.js'],
            'css' => ['camera.css']
        ];

        $pageTitle = _("Share a picture");
        $this->render('images.new', compact('pageTitle', 'logged', 'res'));
    }

    /**
     * @param int $tagId
     */
    public function tag(int $tagId)
    {
        $logged = $this->logged;

        if (($tag = $this->Tag->find($tagId)) === false) {
            $this->notFound();
        }

        $images = $this->Image->lastByTag($tagId);

        $res = [
            'js' => ['progressive-image.js'],
            'css' => ['gallery.css', 'progressive-image.css']
        ];

        $this->render('images.tag', compact('images', 'tag', 'logged', 'res'));
    }

    /**
     * @param int $imageId
     */
    public function show(int $imageId)
    {
        $logged = $this->logged;

        $singleImage = $this->Image->find($imageId);
        $userInfo = $this->User->find(intval($singleImage->users_id));

        if ($singleImage === false) {
            $this->notFound();
        }

        $res = [
            'js' => ['progressive-image.js'],
            'css' => ['gallery.css', 'progressive-image.css']
        ];

        $this->render('images.show', compact('userInfo', 'singleImage', 'logged', 'res', 'userInfo'));
    }
}
