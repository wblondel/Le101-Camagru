<?php declare (strict_types=1);

use Core\Config;
use Core\Database\MysqlDatabase;
use Core\Router;
use Core\Session\Session;

/**
 * Class App
 */
class App
{
    public $title = "Camagru";
    private $router;
    private $db_instance;
    private $session_instance;
    private static $_instance;

    /**
     * @return App
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public static function load()
    {
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getTable($name)
    {
        $class_name = '\\App\\Table\\' . ucfirst($name) . 'Table';
        return new $class_name($this->getDb());
    }

    /**
     * @return MysqlDatabase
     */
    public function getDb()
    {
        $config = Config::getInstance(ROOT . '/config/database.php');
        if (is_null($this->db_instance)) {
            $this->db_instance = new MysqlDatabase(
                $config->getStg('db_name'),
                $config->getStg('db_user'),
                $config->getStg('db_pass'),
                $config->getStg('db_host')
            );
        }
        return $this->db_instance;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        $session = Session::getInstance();
        if (is_null($this->session_instance)) {
            $this->session_instance = $session;
        };
        return $this->session_instance;
    }

    /**
     * @return Router\Router
     */
    public function getRouter()
    {
        if (!isset($_GET['url'])) {
            $_GET['url'] = '/';
        }

        $router = new Router\Router($_GET['url']);

        # Images
        $router->get('/', "Images#index");
        $router->get('/i/:id', "Images#show")->with('id', '[0-9]+');
        $router->get('/i/new', "Images#new");

        # Tags
        $router->get('/t/:id', "Images#tag")->with('id', '[0-9]+');

        # Users
        $router->get('/u/:id', 'Users#show');

        # Accounts
        $router->get('/accounts/register', "Accounts#register");
        $router->post('/accounts/register', "Accounts#register");
        $router->get('/accounts/login', "Accounts#login");
        $router->post('/accounts/login', "Accounts#login");
        $router->get('/accounts/confirm', "Accounts#confirm");
        $router->get('/accounts/logout', "Accounts#logout");
        $router->get('/accounts/forgot', "Accounts#forgot");
        $router->post('/accounts/forgot', "Accounts#forgot");
        $router->get('/accounts/reset', "Accounts#reset");
        $router->post('/accounts/reset', "Accounts#reset");

        $this->router = $router;
        return $this->router;
    }
}
