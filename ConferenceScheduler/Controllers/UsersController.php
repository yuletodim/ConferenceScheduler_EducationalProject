<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 24.11.2015
 * Time: 14:58
 */
namespace Controllers;

use MVCFramework\BaseController;

class UsersController extends \MVCFramework\IdentitySystem\DefaultUsersControler
{
    public function index(){
        echo "<h1>it works</h1>";
    }

    public function edit(){
        echo "<h1>you can edit</h1>";
    }

    public function register(){
        //$this->view->appendToLayout('body', 'users.register');
        $this->view->display('layouts.default');
    }

    public function profile(){
        echo '<h1> You are in.</h1>';
    }
}
