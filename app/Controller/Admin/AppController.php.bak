<?php declare(strict_types=1);

namespace App\Controller\Admin;

use \App;
use \Core\Auth\DBAuth;

/**
 * Class AppController
 * @package App\Controller\Admin
 */
class AppController extends \App\Controller\AppController
{
    public function __construct()
    {
        parent::__construct();
        $app = App::getInstance();
        $auth = new DBAuth($app->getDb(), $app->getSession());
        $auth->restrict();
    }
}