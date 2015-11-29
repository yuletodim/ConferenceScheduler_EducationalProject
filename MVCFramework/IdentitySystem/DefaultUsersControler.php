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
        $confirmPassword = $this->context->getRequest()->getPost('confirm-password');
        if($password != $confirmPassword){
            throw new \Exception('Confirmed password is different than password.');
        }

        $newUser = new \MVCFramework\IdentitySystem\RegisterUserBindingModel($username, $email, $password);
        $appUser = new \MVCFramework\IdentitySystem\ApplicationUser();
        $currentUser = $appUser->register($newUser);
        if($currentUser){
            $this->context->setSession();
            $this->context->setUser($currentUser);
            header("Location: profile");}
//        } else {
//            header("Location: register");
//        }
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
            header("Location: profile");
        } else {
            header("Location: login");
        }
    }

    public function logout(){
        $this->context->getSession()->destroySession();
    }
}