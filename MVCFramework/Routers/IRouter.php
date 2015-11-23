<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 23.11.2015
 * Time: 14:24
 */
namespace MVCFramework\Routers;

interface IRouter{
    public function getUri();
    public function getPost();
}