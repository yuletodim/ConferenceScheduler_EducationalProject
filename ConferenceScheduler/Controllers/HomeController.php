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
        if(!$this->context->isLogged()){
            $this->view->appendToLayout('header', 'partials.header');
            $this->view->appendToLayout('body', 'partials.body');
        } else {

        }

        $this->view->appendToLayout('footer', 'partials.footer');
        $this->view->display('layouts.default_template');
        // $this->view->id = $this->context->getRequest()->getGet(0, 'int');
        // $this->view->test = 'TEST';
        //$this->view->display('layouts.default_template', array('arr' => array(1, 2, 3)));
        // => if edi kakvo si display edi koi si template
    }
}