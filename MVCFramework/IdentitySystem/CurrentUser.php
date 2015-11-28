<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 28.11.2015
 * Time: 17:07
 */

namespace MVCFramework\IdentitySystem;

class CurrentUser
{
    private $id;
    private $username;
    private $password;

    public function __construct($id, $user, $password)
    {
        $this->setId($id)
            ->setUsername($user)
            ->setPassword($password);
    }

    public function getId()
    {
        return $this->id;
    }

    private function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    private function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }
}