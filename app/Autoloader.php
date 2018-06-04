<?php
namespace App;

/**
 * Class Autoloader
 * @package App
 */
class Autoloader {


    /**
     * Enregistre notre autoloader.
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }


    /**
     * Inclut le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload(string $class) {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            $filename = __DIR__ . '/' . $class . '.php';
            if (static::include_exists($filename)) {
                require $filename;
            } else {
            }
        }
    }

    private static function include_exists ($fileName){
        if (realpath($fileName) == $fileName) {
            return is_file($fileName);
        }
        if ( is_file($fileName) ){
            return true;
        }

        $paths = explode(PATH_SEPARATOR, get_include_path());
        foreach ($paths as $path) {
            $rp = substr($path, -1) == DIRECTORY_SEPARATOR ? $path.$fileName : $path. DIRECTORY_SEPARATOR .$fileName;
            if ( is_file($rp) ) {
                return true;
            }
        }
        return false;
    }
}