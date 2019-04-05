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
        $this->loadModel('Effect');
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

        /*if ($singleImage === false) {
            $this->notFound();
        }*/
        if ($singleImage->id === null) {
            $this->notFound();
        }

        if ($singleImage->users_id == $userId) {
            $singleImage->owned_by_current_user = true;
        } else {
            $singleImage->owned_by_current_user = false;
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

        $effects = $this->Effect->all();

        if (!empty($_POST)) {
            if ($this->isAjax()) {
                header('Content-Type: application/json');

                if (isset($_POST['screenshot']) && isset($_POST['effect']) && isset($_POST['position'])) {
                    $screenshotPost = $_POST['screenshot'];
                    $effectPost = $_POST['effect'];
                    $positionPost = $_POST['position'];

                    $screenshotEncoded = substr($screenshotPost, strpos($screenshotPost, ",") + 1);
                    $effectEncoded = substr($effectPost, strpos($effectPost, ",") + 1);

                    $screenshotDecoded = base64_decode($screenshotEncoded);
                    $effectDecoded = base64_decode($effectEncoded);

                    $screenshotImage = imagecreatefromstring($screenshotDecoded);
                    $effectImage = imagecreatefromstring($effectDecoded);


                    if ($screenshotImage !== false || $effectImage !== false) {
                        imagecopy($screenshotImage, $effectImage, intval($positionPost[0]), intval($positionPost[1]), 0, 0, imagesx($effectImage), imagesy($effectImage));
                        $userId = $session->read('auth');

                        // enregistrement de l'image sur le serveur
                        $imageFilename = uniqid() . ".jpg";
                        imagejpeg($screenshotImage, ROOT . "/public/uploads/pictures/" . $imageFilename);

                        // enregistrement dans la base de donnees
                        $resCreate = $this->Image->create([
                            'description' => '',
                            'users_id' => $userId,
                            'filename' => $imageFilename,
                        ]);

                        if ($resCreate) {
                            echo json_encode([
                                'result' => true,
                                'imageFilename' => $imageFilename,
                                'imageId' => $db->lastInsertId()
                            ]);
                        } else {
                            unlink(ROOT . "/public/uploads/pictures/" . $imageFilename);
                            http_response_code(400);
                            echo json_encode(['result' => false]);
                        }
                        imagedestroy($screenshotImage);
                        imagedestroy($effectImage);
                    } else {
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
        } else {
            $this->template = 'default';
            $this->render(
                'images.new',
                compact('effects'),
                _("Share a picture"),
                ['js' => ['camera.js'], 'css' => ['camera.css']]
            );
        }
    }

    /**
     * Delete an image
     */
    public function delete(int $imageId)
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);
        $auth->restrict();

        if (!empty($_POST)) {
            if (!empty($_POST['csrf_token'])) {
                if (hash_equals($session->read('csrf_token'), $_POST['csrf_token'])) {
                    $userId = $session->read('auth');
                    if (!$userId) {
                        $userId = -1;
                    }

                    $singleImage = $this->Image->findWithDetails($imageId, intval($userId));

                    if ($singleImage->id === null) {
                        $this->notFound();
                    }

                    if ($singleImage->users_id == $userId) {
                        //delete the image
                        $this->Image->delete(intval($singleImage->id));
                        unlink(ROOT . "/public/uploads/pictures/" . $singleImage->filename);
                        $session->setFlash('success', _("The image has been succesfully deleted."));
                        $this->redirect();
                    } else {
                        $this->forbidden();
                    }
                } else {
                    $this->forbidden();
                }
            } else {
                $this->forbidden();
            }
        } else {
            $this->badRequest();
        }
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
