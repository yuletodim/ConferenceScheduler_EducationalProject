<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 22.11.2015
 * Time: 10:56
 */
namespace MVCFramework;

class Config{
    private static $_instance = null;
    private $_configFolder = null;
    // cache all included files
    private $_configArray = array();

    private function __construct(){
    }

    /**
     * \MVCFramework\Config
     */
    public static function getInstance(){
        if(self::$_instance == NULL){
            self::$_instance = new \MVCFramework\Config();
        }

        return self::$_instance;
    }

    // return the current state of config folder
    public function getConfigFolder(){
        return $this->_configFolder;
    }

    public function setConfigFolder(string $configFolder){
        if(!$configFolder){
            throw new \Exception('Emtpy config folder path.');
        }

        $_configFolder = realpath($configFolder);
        if($_configFolder != FALSE && is_dir($_configFolder) && is_readable($_configFolder)){
            // clear old config data
            $this->_configArray = array();
            $this-> _configFolder = $_configFolder.DIRECTORY_SEPARATOR;
            // register all namespaces from app config??
            $namespaces = $this->app['namespaces'];
            if(is_array($namespaces)){
                \MVCFramework\Loader::registerNamespaces($namespaces);
            }
        } else {
            throw new \Exception('Config directory read error: ' . $configFolder);
        }

        echo "Actual config folder from getConfigFolder method: " . $configFolder . "<br/>";
    }

    // magic function that adds/gets a feature
    public function __get(string $name){
        // if $name is not a key in the array, include it
        if(!$this->_configArray[$name]){
            $this->includeConfigFile($this->_configFolder . $name . '.php');
        }

        // if $name is included correctly, return all array
        if(array_key_exists($name, $this->_configArray)){
            return $this->_configArray[$name];
        }

        return null;
    }

    public function includeConfigFile(string $path){
        if(!$path){
            throw new \Exception ('Invalid path.');
        }

        $_file = realpath($path);
        if($_file != FALSE && is_file($_file) && is_readable($_file)){
            $_baseName = explode('.php', baseName($_file))[0];
            include $_file;
            $this->_configArray[$_baseName] = include $_file;
        } else {
            throw new \Exception('Config file read error: ' . $path);
        }
    }
}
