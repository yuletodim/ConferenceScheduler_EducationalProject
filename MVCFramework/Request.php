<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 28.11.2015
 * Time: 12:51
 */

namespace MVCFramework;

class Request
{
    private $_get = array();
    private $_post = array();

    public function __construct(array $get = [], array $post = []){
        $this->setGet($get);
        $this->setPost($post);
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

    public function getGetArray() : array {
        return $this->_get;
    }

    public function getPostArray() : array {
        return $this->_post;
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
}