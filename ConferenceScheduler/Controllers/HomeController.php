<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 24.11.2015
 * Time: 15:21
 */
namespace Controllers;

class HomeController{
    public function index(){
        $view = \MVCFramework\View::getInstance();
        $view->test = 'TEST';
        $view->appendToLayout('body', 'index');
        $view->appendToLayout('side', 'side_bar');
        $view->display('Layouts.default_template', array('arr' => array(1, 2, 3)));
        // => if edi kakvo si display edi koi si template
    }
}