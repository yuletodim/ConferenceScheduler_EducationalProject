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
        $this->view->appendToLayout('header', 'partials.header');
        $this->view->appendToLayout('body', 'users.register');
        $this->view->appendToLayout('footer', 'partials.footer');
        $this->view->display('layouts.default_template');
        if($this->context->getRequest()->getPostArray()){
            try{
                parent::register();
            } catch(\Exception $ex){
                $this->view->error = $ex->getMessage();
                echo '<div class="text-warning">' . $ex->getMessage() . '</div>';
            }
        }
    }

    public function login(){
        $this->view->appendToLayout('header', 'partials.header');
        $this->view->appendToLayout('body', 'users.login');
        $this->view->appendToLayout('footer', 'partials.footer');
        $this->view->display('layouts.default_template');
        if($this->context->getRequest()->getPostArray()){
            try{
                parent::login();
            } catch(\Exception $ex){
                $this->view->error = $ex->getMessage();
                echo '<div>' . $ex->getMessage() . '</div>';
            }
        }
    }

    public function profile(){
        echo '<h1> You are in.</h1>';
    }
}
