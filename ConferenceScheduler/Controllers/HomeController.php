<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 24.11.2015
 * Time: 15:21
 */
namespace Controllers;

class HomeController extends \MVCFramework\BaseController
{
    public function index(){


//        $view = \MVCFramework\View::getInstance();
//        $view->id = \MVCFramework\HttpContext::getInstance()->getGet(0, 'int');

        $this->view->id = $this->context->getRequest()->getGet(0, 'int');
        $this->view->test = 'TEST';
        $this->view->appendToLayout('layout_header', 'partials.layout_header');
        $this->view->appendToLayout('body', 'index');
        //$this->view->appendToLayout('side', 'partials.side_bar');
        $this->view->display('layouts.default_template', array('arr' => array(1, 2, 3)));
        // => if edi kakvo si display edi koi si template
    }
}