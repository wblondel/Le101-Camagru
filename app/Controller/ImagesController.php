<?php declare(strict_types=1);

namespace App\Controller;

use App;
use Core\Auth\DBAuth;
use Core\Email\Email;

/**
 * Class ImagesController
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
        $this->loadModel('Comment');
    }

    /**
     *  Main page: public gallery
     */
    public function index()
    {
        $session = App::getInstance()->getSession();
        $userId = $session->read('auth');
        if (!$userId) {
            $userId = -1;
        }
        $images = $this->Image->last(intval($userId));

        $this->render(
            'images.index',
            compact('images'),
            null,
            ['js' => ['main.js', 'progressive-image.js', 'like.js'], 'css' => ['gallery.css', 'progressive-image.css']]
        );
    }

    /**
     * Single image page
     * @param int $imageId
     */
    public function show(int $imageId)
    {
        $session = App::getInstance()->getSession();
        $userId = $session->read('auth');
        if (!$userId) {
            $userId = -1;
        }
        $singleImage = $this->Image->findWithDetails($imageId, intval($userId));

        if ($singleImage === false) {
            $this->notFound();
        }

        $comments = $this->Comment->findForImage(intval($singleImage->id));


        $this->render(
            'images.show',
            compact('singleImage', 'comments'),
            null,
            ['js' => ['main.js', 'progressive-image.js', 'like.js', 'comment.js'], 'css' => ['gallery.css', 'progressive-image.css', 'comments.css']]
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
            ['js' => ['main.js', 'progressive-image.js', 'like.js'], 'css' => ['gallery.css', 'progressive-image.css']]
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

        sleep(1);

        if ($this->isAjax()) {
            header('Content-Type: application/json');
            if (!empty($_POST)) {
                try {
                    $userId = $session->read('auth');

                    if ($_POST['reactType'] == 1) {
                        $result = $this->Like->create([
                            'users_id' => $userId,
                            'images_id' => $imageId,
                        ]);

                        $singleImage = $this->Image->findWithDetails($imageId, intval($userId));
                    } elseif ($_POST['reactType'] == 0) {
                        $result = $this->Like->unlike(intval($userId), $imageId);
                        $singleImage = $this->Image->findWithDetails($imageId, intval($userId));
                    }

                    echo json_encode([
                        'result' => $result,
                        'likes' => $singleImage->likes,
                        'liked_by_user' => intval($singleImage->liked_by_user)
                    ]);
                } catch (\PDOException $e) {
                    http_response_code(400);
                    echo json_encode(['result' => false]);
                }
            } else {
                http_response_code(400);
                echo json_encode(['result' => false]);
            }
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
