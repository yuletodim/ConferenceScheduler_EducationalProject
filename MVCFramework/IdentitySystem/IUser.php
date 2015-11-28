<?php

/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 28.11.2015
 * Time: 14:06
 */
namespace MVCFramework\IdentitySystem;

interface IUser
{
    public function register(\MVCFramework\IdentitySystem\RegisterUserBindingModel $registerUserBindingModel);

    public function login(\MVCFramework\IdentitySystem\LoginUserBindingModel $loginUserBindingModel);
}