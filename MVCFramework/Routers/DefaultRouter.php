<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 23.11.2015
 * Time: 12:24
 */
namespace MVCFramework\Routers;

class DefaultRouter{
    public function getUri(){
        $nameLength = strlen($_SERVER['SCRIPT_NAME']) + 1;
        $_uri = substr($_SERVER['PHP_SELF'], $nameLength);

//        echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "<br/>";
//        echo "PHP_SELF: " . $_SERVER['PHP_SELF'] . "<br/>";
        echo "URI: " . $_uri . "<br/>";

        return $_uri;
    }
}