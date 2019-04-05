<?php declare(strict_types=1);

namespace App\Controller;

use App;
use Core\Auth\DBAuth;
use Core\Email\Email;

/**
 * Class CommentsController
 *
 * @package App\Controller
 */
class CommentsController extends AppController
{
    protected $template = '';

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Comment');
        $this->loadModel('Image');
        $this->loadModel('User');
    }

    /**
     * Add a comment
     *
     * @param int $imageId
     */
    public function add(int $imageId)
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);
        $auth->restrict();

        sleep(1);

        if ($this->isAjax()) {
            header('Content-Type: application/json');

            if (!empty($_POST) && isset($_POST['commentContent'])) {
                $commentContent = trim($_POST['commentContent']);

                if ($commentContent === '') {
                    http_response_code(400);
                    echo json_encode(['result' => false]);
                } else {
                    try {
                        $result = $this->Comment->create([
                            'users_id' => $session->read('auth'),
                            'images_id' => $imageId,
                            'comment' => $commentContent
                        ]);

                        $insertedComment = $this->Comment->findWithDetails(intval($db->lastInsertId()));

                        $singleImage = $this->Image->findWithDetails($imageId, intval($session->read('auth')));
                        $authorUserInfo = $this->User->find(intval($singleImage->users_id));

                        if ($authorUserInfo->receive_email_on_comment) {
                            $mailer = Email::make()
                                ->setTo($authorUserInfo->email, $authorUserInfo->username)
                                ->setFrom('contact@camagru.fr', 'Camagru.fr')
                                ->setSubject($insertedComment->username . " " . _("commented your image"))
                                ->setMessage('<p>' .
                                    _("Hello") . ' ' . $authorUserInfo->username . '</p><br>' .
                                    $insertedComment->username . ' ' . _("commented your image") . ': ' .
                                    '<a href="https://camagru.fr' . $singleImage->getUrl() . '">https://camagru.fr' . $singleImage->getUrl() . '</a>' .
                                    '<p>' . htmlentities($insertedComment->comment) . '</p>')
                                ->setReplyTo('contact@camagru.fr')
                                ->setHtml()
                                ->send();
                        }

                        echo json_encode([
                            'result' => $result,
                            'comment' => $insertedComment->getHTML()
                        ]);
                    } catch (\PDOException $e) {
                        http_response_code(400);
                        echo json_encode(['result' => false]);
                    }
                }
            } else {
                http_response_code(400);
                echo json_encode(['result' => false]);
            }
        } else {
            $this->forbidden();
        }
    }

    /**
     * Remove a comment
     *
     * @param int $commentId
     */
    public function remove(int $commentId)
    {
        $session = App::getInstance()->getSession();
        $db = App::getInstance()->getDb();
        $auth = new DBAuth($db, $session);
        $auth->restrict();

        $userId = $session->read('auth');

        sleep(1);

        if ($this->isAjax()) {
            header('Content-Type: application/json');
            if (!empty($_POST)) {
                try {
                    // test
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

    private function isAjax()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}
