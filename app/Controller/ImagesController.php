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
        $this->loadModel('Like');
    }

    /**
     *  Main page: public gallery
     */
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

    /**
     * Single image page
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

    /**
     * Take a picture page
     */
    public function new()
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);
        $auth->restrict();

        $this->template = 'default';

        $this->render(
            'images.new',
            [],
            _("Share a picture"),
            ['js' => ['camera.js'], 'css' => ['camera.css']]
        );
    }

    /**
     * Explore a tag
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
     * Like an image
     * @param int $imageId
     */
    public function like(int $imageId)
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);
        $auth->restrict();

        if (!empty($_POST) && $this->isAjax()) {
            $result = $this->Like->create([
                'users_id' => $session->read('auth'),
                'images_id' => $imageId,
            ]);

            // TODO: Return correct AJAX response
            header('Content-Type: application/json');
            echo json_encode(['return' => $result]);

            //         echo json_encode($errors);
            //        header('Content-Type: application/json');
            //        http_response_code(400);
        } else {
            $this->forbidden();
        }
    }

    // TODO: Move this function somewhere more appropriate
    private function isAjax()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}
