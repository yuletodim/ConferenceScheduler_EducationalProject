<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 24.11.2015
 * Time: 15:33
 */
namespace Admin\Controllers;

class HomeController extends \MVCFramework\BaseController
{
    public function index(){
        //$view = \MVCFramework\View::getInstance();
        $this->view->username = 'admin';
        $this->view->display('admin.index');
    }
}