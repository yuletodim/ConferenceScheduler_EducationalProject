<?php

/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 28.11.2015
 * Time: 14:28
 */
namespace MVCFramework\IdentitySystem;

class RegisterUserBindingModel
{
    private $username;
    private $email;
    private $password;

    public function __construct(string $username, string $email, string $password){
        $this->setUsername($username)
            ->setEmail($email)
            ->setPassword($password);
    }

    public function setUsername(string $username){
        $this->username = $username;
        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setEmail(string $email){
        $this->email = $email;
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setPassword(string $password){
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }
}