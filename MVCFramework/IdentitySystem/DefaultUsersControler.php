<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 28.11.2015
 * Time: 14:56
 */

namespace MVCFramework\IdentitySystem;


class DefaultUsersControler extends \MVCFramework\BaseController
{
    public function register(){
        $username = $this->context->getRequest()->getPost('username');
        $email = $this->context->getRequest()->getPost('email');
        $password = $this->context->getRequest()->getPost('password');
        $repeatPassword = $this->context->getRequest()->getPost('repeat-password');
        if($password != $repeatPassword){
            throw new \Exception('Repeated password is diferent than password.');
        }

        $newUser = new \MVCFramework\IdentitySystem\RegisterUserBindingModel($username, $email, $password);
        $appUser = new \MVCFramework\IdentitySystem\ApplicationUser();
        $currentUser = $appUser->register($newUser);
        if($currentUser){
            $this->context->setSession();
            $this->context->setUser($currentUser);
            header("Location: users/profile");
        } else {
            header("Location: users/register");
        }
    }

    public function login(){
        $username = $this->context->getRequest()->getPost('username');
        $password = $this->context->getRequest()->getPost('password');

        $loggedUser = new \MVCFramework\IdentitySystem\LoginUserBindingModel($username, $password);
        $appUser = new \MVCFramework\IdentitySystem\ApplicationUser();
        $currentUser = $appUser->login($loggedUser);
        if($currentUser){
            $this->context->setSession();
            $this->context->setUser($currentUser);
            header("Location: users/profile");
        } else {
            header("Location: users/login");
        }
    }

    public function logout(){
        $this->context->getSession()->destroySession();
    }
}