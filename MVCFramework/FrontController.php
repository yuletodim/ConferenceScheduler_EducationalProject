<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 23.11.2015
 * Time: 12:05
 */
namespace MVCFramework;

class FrontController{
    private static $_instance = null;

    private function __construct(){

    }

    /**
     * @return \MVCFramework\FrontController
     */
    public static function getInstance(){
        if(self::$_instance == NULL){
            self::$_instance = new \MVCFramework\FrontController();
        }

        return self::$_instance;
    }

    public function dispatch(){
        $test = new \MVCFramework\Routers\DefaultRouter();
        $test->getUri();
    }
}
