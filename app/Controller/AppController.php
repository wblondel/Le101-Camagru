<?php declare(strict_types=1);

namespace App\Controller;

use App;
use Core\Auth\DBAuth;
use Core\Controller\Controller;

/**
 * Class AppController
 *
 * @package App\Controller
 */
class AppController extends Controller
{
    protected $template = 'default';
    protected $logged = false;

    /**
     * AppController constructor.
     */
    public function __construct()
    {
        $this->viewPath = ROOT . '/app/Views/';
        $auth = new DBAuth(App::getInstance()->getDb(), App::getInstance()->getSession());
        $auth->connectFromCookie();
        $this->logged = $auth->isLogged();
        if ($this->logged && !$auth->connectedUserExists()) {
            $auth->logout();
        }
    }

    /**
     * @param $model_name
     */
    protected function loadModel($model_name)
    {
        $this->$model_name = App::getInstance()->getTable($model_name);
    }
}
