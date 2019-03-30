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
        //$images = $this->Image->lastWithTags();
        $images = $this->Image->last();

        $this->render(
            'images.index',
            compact('images'),
            null,
            ['js' => ['progressive-image.js'], 'css' => ['gallery.css', 'progressive-image.css']]
        );
    }

    public function new()
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);
        $auth->restrict();

        $this->template = 'default';

        $this->render(
            'images.new',
            null,
            _("Share a picture"),
            ['js' => ['camera.js'], 'css' => ['camera.css']]
        );
    }

    /**
     * @param int $tagId
     */
    public function tag(int $tagId)
    {
        if (($tag = $this->Tag->find($tagId)) === false) {
            $this->notFound();
        }

        $images = $this->Image->lastByTag($tagId);

        $this->render(
            'images.tag',
            compact('images', 'tag'),
            null,
            ['js' => ['progressive-image.js'], 'css' => ['gallery.css', 'progressive-image.css']]
        );
    }

    /**
     * @param int $imageId
     */
    public function show(int $imageId)
    {
        $singleImage = $this->Image->find($imageId);
        $userInfo = $this->User->find(intval($singleImage->users_id));

        if ($singleImage === false) {
            $this->notFound();
        }

        $this->render(
            'images.show',
            compact('singleImage', 'userInfo'),
            null,
            ['js' => ['progressive-image.js'], 'css' => ['gallery.css', 'progressive-image.css']]
        );
    }
}
