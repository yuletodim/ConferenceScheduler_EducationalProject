<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 24.11.2015
 * Time: 18:08
 */
namespace MVCFramework;

class HttpContext{
    private static $_instance = null;
    private $_get = array();
    private $_post = array();
    private $_cookies = array();

    private function __construct(){
        $this->_cookies = $_COOKIE;
    }

    public static function getInstance() : \MVCFramework\HttpContext{
        if(self::$_instance == NULL){
            self::$_instance = new \MVCFramework\HttpContext();
        }

        return self::$_instance;
    }

    public function setGet(array $getInput){
        $this->_get = $getInput;
    }

    public function setPost(array $postInput){
        $this->_post = $postInput;
    }

    public function hasGetValue(int $position) : bool{
        return array_key_exists($position, $this->_get);
    }

    public function hasPostValue(string $name) : bool{
        return array_key_exists($name, $this->_post);
    }

    public function hasCookieValue(string $name) : bool{
        return array_key_exists($name, $this->_cookies);
    }

    public function getGetArray() : array {
        return $this->_get;
    }

    public function getPostArray() : array {
        return $this->_post;
    }

    public function getCookiesArray() : array{
        return $this->_cookies;
    }

    public function getGet(int $position, string $normalize = null, $defaultValue = null){
        if($this->hasGetValue($position)){
            if($normalize != NULL){
                return \MVCFramework\Utilities::normalize($this->_get[$position], $normalize);
            }

            return $this->_get[$position];
        }

        return $defaultValue;
    }

    public function getPost(string $name, string $normalize = null, $defaultValue = null){
        if($this->hasPostValue($name)){
            if($normalize != NULL){
                return \MVCFramework\Utilities::normalize($this->_post[$name], $normalize);
            }

            return $this->_post[$name];
        }

        return $defaultValue;
    }

    public function getCookies(string $name, string $normalize = null, $defaultValue = null){
        if($this->hasCookieValue($name)){
            if($normalize != NULL){
                return \MVCFramework\Utilities::normalize($this->_cookies[$name], $normalize);
            }

            return $this->_cookies[$name];
        }

        return $defaultValue;
    }
}