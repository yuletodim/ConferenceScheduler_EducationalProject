<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 27.11.2015
 * Time: 11:00
 */
namespace MVCFramework;

class View
{
    private static $_instance = null;
    private $_viewsDirPath = null;
    private $_viewDir = null;
    private $_viewData = array();


    private function __construct(){
        $this->_viewsDirPath = $this->getPathViewsDir();
    }

    public static function getInstance() : \MVCFramework\View{
        if(self::$_instance == NULL){
            self::$_instance = new \MVCFramework\View();
        }

        return self::$_instance;
    }

    public function __set(string $name, $value){
        $this->_viewData[$name] = $value;
    }

    public function __get(string $name){
        return $this->_viewData[$name];
    }

    public function setViewDir(string $path){
        $path = trim($path);
        if($path) {
            $path = realpath($path) . DIRECTORY_SEPARATOR;
            if (is_dir($path) && is_readable($path)) {
                $this->_viewDir = $path;
            } else {
                throw new \Exception('Invalid path for view directory.', 500);
            }
        } else {
            throw new \Exception('Invalid path for view directory.', 500);
        }
    }

    public function getPathViewsDir() : string{
        $pathViewsDir = \MVCFramework\App::getInstance()->getConfig()->app['views_dir'];
        if($pathViewsDir == NULL){
            $pathViewsDir = 'Views';
        }

        return realpath($pathViewsDir);
    }
}