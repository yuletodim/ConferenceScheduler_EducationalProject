<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 23.11.2015
 * Time: 12:24
 */
namespace MVCFramework\Routers;

class DefaultRouter implements \MVCFramework\Routers\IRouter{
    public function getUri(){
//        $nameLength = strlen($_SERVER['SCRIPT_NAME']) + 1;
//        $_uri = substr($_SERVER['PHP_SELF'], $nameLength);
        $appName = \MVCFramework\App::getInstance()->getConfig()->app['app_name'];
        $_uri = $_SERVER['REQUEST_URI'];
        $_uri = substr($_uri, strlen($appName)+2);

        return $_uri;
    }

    public function getPost(){
        return $_POST;
    }
}