<?php declare(strict_types=1);

namespace App\Controller;

use App;
use Core\Auth\DBAuth;
use Core\Email\Email;

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
            ['js' => ['progressive-image.js', 'like.js'], 'css' => ['gallery.css', 'progressive-image.css']]
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

        $this->render(
            'images.show',
            compact('singleImage'),
            null,
            ['js' => ['progressive-image.js', 'like.js'], 'css' => ['gallery.css', 'progressive-image.css']]
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
            ['js' => ['progressive-image.js', 'like.js'], 'css' => ['gallery.css', 'progressive-image.css']]
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

        $userId = $session->read('auth');

        if ($this->isAjax()) {
            header('Content-Type: application/json');
            if (!empty($_POST)) {
                try {
                    if ($_POST['reactType'] == 1) {
                        $result = $this->Like->create([
                            'users_id' => $session->read('auth'),
                            'images_id' => $imageId,
                        ]);
                    } elseif ($_POST['reactType'] == 0) {
                        $result = $this->Like->unlike(intval($session->read('auth')), $imageId);
                    }

                    $singleImage = $this->Image->findWithDetails($imageId, intval($userId));

                    $user = $this->User->find(intval($userId));
                    $userImage = $this->User->find($singleImage->users_id);

                    $mailer = Email::make()
                        ->setTo($userImage->email, $userImage->username)
                        ->setFrom('contact@camagru.fr', 'Camagru.fr')
                        ->setSubject($user->username . " " . _("liked your image"))
                        ->setMessage('<p>' .
                            _("Hello") . ' ' . $userImage->username . '</p><br>' .
                            $user->username . ' ' . 'liked your image:' . ' ' .
                            '<a href="https://camagru.fr/i/' . $singleImage->id . '">' . '</a>')
                        ->setReplyTo('contact@camagru.fr')
                        ->setHtml()
                        ->send();
                    
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
