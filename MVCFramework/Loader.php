<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 21.11.2015
 * Time: 21:33
 */
namespace MVCFramework;

final class Loader{
    private static $namespaces = array();

    private function __construct(){

    }

    public static function registerAutoload(){
        spl_autoload_register(array("\MVCFramework\Loader"), autoload);
    }

    public static function autoload($class){
        self::loadClass($class);
    }

    public static function loadClass($class){
        foreach(self::$namespaces as $key=> $value){
            if(strpos($class, $key) === 0){

            }

        }
    }

    public static function registerNamespace($namespace, $path){
        $namespace = trim($namespace);
        if(strlen($namespace) > 0){
            if(!$path){
                throw new \Exception('Invalid path.');
            }

            $_path = realpath($path);
            if($_path && is_dir($_path) && is_readable($_path)){
                self::$namespaces[$namespace] = $_path . DIRECTORY_SEPARATOR;
            } else {
                throw new \Exception('Namespace directory error: ' . $path);
            }
        } else {
            throw new \Exception('Invalid namespace: ' . $namespace);
        }
    }
}