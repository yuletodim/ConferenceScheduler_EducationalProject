<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 24.11.2015
 * Time: 15:33
 */
namespace Admin\Controllers;

class HomeController{
    public function index(){
        $view = \MVCFramework\View::getInstance();
        $view->username = 'admin';
        $view->display('Admin.index');


    }
}