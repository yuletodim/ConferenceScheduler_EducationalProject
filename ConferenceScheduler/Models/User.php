<?php

/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 28.11.2015
 * Time: 19:16
 */
namespace Models;

class User extends \MVCFramework\IdentitySystem\CurrentUser
{
    private $firstName;
    private $lastName;

    public function setFirstName(string $firstName){
        $this->firstName = $firstName;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function setLastName(string $lastName){
        $this->lastName = $lastName;
    }

    public function getLastName(){
        return $this->lastName;
    }
}