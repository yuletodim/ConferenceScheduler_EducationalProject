<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 28.11.2015
 * Time: 19:21
 */

namespace Models;

class UserViewModel extends \MVCFramework\Database
{
    private $id;
    private $username;
    private $email;
    private $firstName;
    private $lastName;

    public function __construct(
            string $connection = null,
            int $id,
            string $username,
            string $email,
            string $firstName,
            string $lastName)
    {
        parent::__construct($connection);
        $this->setId($id)
            ->setUsername($username)
            ->setEmail($email)
            ->setFirstName($firstName)
            ->setL;
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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
}