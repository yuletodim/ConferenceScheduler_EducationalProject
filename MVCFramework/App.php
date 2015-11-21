<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 21.11.2015
 * Time: 21:09
 */
namespace MVCFramework;

include_once 'Loader.php';

class App{
    private static $_instance = null;

    private function __construct(){
        \MVCFramework\Loader::registerNamespace('MVCFramework', dirname(__FILE__) . DIRECTORY_SEPARATOR);
        \MVCFramework\Loader::registerAutoload();
    }

    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new \MVCFramework\App();
        }

        return self::$_instance;
    }

    public function run(){
        echo "main method";
    }
}
