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

    public function __construct(int $id, string $user, string $password)
    {
        $this->setId($id)
            ->setUsername($user)
            ->setPassword($password);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }
}