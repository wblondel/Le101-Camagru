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
    private $dbInstance;
    private $sessionInstance;
    private static $instance;

    /**
     * @return App
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    public static function load()
    {
        require ROOT . DS . 'app' . DS . 'Autoloader.php';
        App\Autoloader::register();
        require ROOT . DS . 'core' . DS . 'Autoloader.php';
        Core\Autoloader::register();
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getTable($name)
    {
        $className = '\\App\\Table\\' . ucfirst($name) . 'Table';
        return new $className($this->getDb());
    }

    /**
     * @return MysqlDatabase
     */
    public function getDb()
    {
        $config = Config::getInstance(ROOT . DS . 'config' . DS . 'database.php');
        if (is_null($this->dbInstance)) {
            $this->dbInstance = new MysqlDatabase(
                $config->getStg('db_name'),
                $config->getStg('db_user'),
                $config->getStg('db_pass'),
                $config->getStg('db_host')
            );
        }
        return $this->dbInstance;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        $session = Session::getInstance();
        if (is_null($this->sessionInstance)) {
            $this->sessionInstance = $session;
        };
        return $this->sessionInstance;
    }

    /**
     * @param string $url
     *
     * @return Router\Router
     */
    public function getRouter(string $url)
    {
        $router = new Router\Router($url);

        # Images
        $router->get('/', "Images#index");
        $router->get('/i/:id', "Images#show")
            ->with('id', '[0-9]+');
        $router->get('/i/new', "Images#new");

        # Tags
        $router->get('/t/:tagId', "Images#tag")
            ->with('tagId', '[0-9]+');

        # Users
        $router->get('/u/:username', 'Users#show')
            ->with('username', '[a-zA-Z0-9]+');

        # Accounts
        $router->get('/accounts/register', "Accounts#register");
        $router->post('/accounts/register', "Accounts#register");
        $router->get('/accounts/login', "Accounts#login");
        $router->post('/accounts/login', "Accounts#login");
        $router->get('/accounts/confirm/:id/:token', "Accounts#confirm")
            ->with('id', '[0-9]+')
            ->with('token', '[a-zA-Z0-9]+');
        $router->get('/accounts/logout', "Accounts#logout");
        $router->get('/accounts/forgot', "Accounts#forgot");
        $router->post('/accounts/forgot', "Accounts#forgot");
        $router->get('/accounts/reset/:userId/:token', "Accounts#reset")
            ->with('userId', '[0-9]+')
            ->with('token', '[a-zA-Z0-9]+');
        $router->post('/accounts/reset/:userId/:token', "Accounts#reset")
            ->with('userId', '[0-9]+')
            ->with('token', '[a-zA-Z0-9]+');

        $this->router = $router;
        return $this->router;
    }
}
