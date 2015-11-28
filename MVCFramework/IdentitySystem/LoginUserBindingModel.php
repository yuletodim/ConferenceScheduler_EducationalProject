<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 28.11.2015
 * Time: 14:59
 */

namespace MVCFramework\IdentitySystem;

class LoginUserBindingModel
{
    private $username;
    private $password;

    public function __construct(string $username, string $password){
        $this->setUsername($username)
            ->setPassword($password);
    }

    public function setUsername(string $username){
        $this->username = $username;
        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setPassword(string $password){
        $this->password = $password;
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }
}