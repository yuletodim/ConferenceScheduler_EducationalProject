<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 28.11.2015
 * Time: 14:21
 */

namespace MVCFramework\IdentitySystem;

class ApplicationUser extends \MVCFramework\Database implements \MVCFramework\IdentitySystem\IUser
{
    public function register(\MVCFramework\IdentitySystem\RegisterUserBindingModel $registerUserBindingModel){
        if($this->existUser($registerUserBindingModel->getUsername())){
            throw new \Exception('User with username ' . $registerUserBindingModel->getUsername() . ' already exists.');
        }

        $result = $this->prepare("INSERT INTO users (username, email, password, role_id)
            VALUES (?, ?, ?, ?);");
        $result->execute([
            $registerUserBindingModel->getUsername(),
            $registerUserBindingModel->getEmail(),
            $registerUserBindingModel->getPassword(),
            1
        ]);
        if($result->getAffectedRows() > 0){
            $id = $result->getLastInsertId();
            $currentUser = $this->getUser($id);
            return $currentUser;
        } else {
            throw new \Exception ('Can not register user.');
        }
    }

    public function login(\MVCFramework\IdentitySystem\LoginUserBindingModel $loginUserBindingModel){
        $result = $this->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $result->execute([$loginUserBindingModel->getUsername()]);
        $rowUser = $result->fetchRowAssoc();

        if($result->fetchRowNum() <= 0){
            throw new \Exception('Invalid user name.');
        }

        if (password_verify($loginUserBindingModel->getPassword(), $rowUser['password'])) {
            $currentUser = $this->getUser($rowUser['id']);
            return $currentUser;
        }

        throw new \Exception('Invalid credentials');
    }

    public function getUser($id) : \MVCFramework\IdentitySystem\CurrentUser{
        $result = $this->prepare("SELECT id, username, password FROM users WHERE id = ?");
        $result->execute([$id]);
        $rowUser = $result->fetchRowAssoc();
        $currentUser = new \MVCFramework\IdentitySystem\CurrentUser(
            $rowUser['id'], $rowUser['username'], $rowUser['password']);

        return $currentUser;
    }

    public function existUser(string $username){
        $result = $this->prepare("SELECT id FROM users WHERE username = ?");
        $result->execute([$username]);
        if($result->fetchRowAssoc()){
            return true;
        }

        return false;
    }
}