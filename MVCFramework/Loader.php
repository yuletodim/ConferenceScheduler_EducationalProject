<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 21.11.2015
 * Time: 21:33
 */
namespace MVCFramework;

final class Loader
{
    private static $namespaces = array();

    const FILE_EXTENSION = '.php';

    private function __construct(){

    }

    public static function registerAutoLoad(){
        spl_autoload_register(array("\MVCFramework\Loader", 'loadClass'));
    }

    public static function loadClass(string $class){
        // echo 'Path of loaded class: ' . $class .'<br>';
        foreach(self::$namespaces as $key=> $value){
            if(strpos($class, $key) === 0){
                $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
                $file = substr_replace($file, $value, 0, strlen($key)) . self::FILE_EXTENSION;
                $file = realpath($file);
                if($file && is_readable($file)){
                    // echo 'Loaded class: ' . $file .'<br>';
                    include $file;
                } else {
                    throw new \Exception("Can not find file: " . $file);
                }
            }
        }
    }

    public static function registerNamespace(string $namespace, string $path){
        $namespace = trim($namespace);
        if(strlen($namespace) > 0){
            if(!$path){
                throw new \Exception('Invalid path.');
            }

            $_path = realpath($path);
            if($_path && is_dir($_path) && is_readable($_path)){
                self::$namespaces[$namespace . '\\'] = $_path . DIRECTORY_SEPARATOR;
                // echo "Loader registered namespace: " . $namespace . '\\' . ' -> '. $_path . DIRECTORY_SEPARATOR . "<br/>";
            } else {
                throw new \Exception('Namespace directory error: ' . $path);
            }
        } else {
            throw new \Exception('Invalid namespace: ' . $namespace);
        }
    }

    public static function registerNamespaces(array $namespaces_array){
        if(is_array($namespaces_array)){
            foreach($namespaces_array as $key => $value){
                self::registerNamespace($key, $value);
            }
        }else{
            throw new \Exception('Invalid namespace.');
        }
    }

    public static function getNamespaces(){
        return self::$namespaces;
    }
}