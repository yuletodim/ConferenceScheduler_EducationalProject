<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 27.11.2015
 * Time: 20:42
 */
namespace MVCFramework;

class BaseController
{
    /**
     * @var \MVCFramework\App
     */
    protected $app;
    /**
     * @var \MVCFramework\View
     */
    protected $view;
    /**
     * @var \MVCFramework\Config
     */
    protected $config;
    /**
     * @var \MVCFramework\HttpContext
     */
    protected $context;

    public function __construct(){
        $this->app = \MVCFramework\App::getInstance();
        $this->view = \MVCFramework\View::getInstance();
        $this->config = $this->app->getConfig();
        $this->context = \MVCFramework\HttpContext::getInstance();
    }
}