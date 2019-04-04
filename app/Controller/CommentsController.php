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

        if ($this->isAjax()) {
            header('Content-Type: application/json');
            if (!empty($_POST)) {
                try {
                    $result = $this->Comment->create([
                        'users_id' => $session->read('auth'),
                        'images_id' => $imageId,
                        'comment' => $_POST['commentContent']
                    ]);

                    $insertedComment = $this->Comment->findWithDetails(intval($db->lastInsertId()));

                    echo json_encode([
                        'result' => $result,
                        'comment' => [
                            'id' => $insertedComment->id,
                            'content' => htmlentities($insertedComment->comment),
                            'username' => $insertedComment->username,
                            'createdDate' => $insertedComment->getCreationDate()
                        ]
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
