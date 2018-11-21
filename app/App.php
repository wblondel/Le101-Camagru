<?php declare(strict_types=1);

use Core\Config;
use Core\Database\MysqlDatabase;
use Core\Session\Session;

/**
 * Class App
 */
class App
{
    public $title = "Camagru";

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
}
