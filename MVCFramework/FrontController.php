<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 23.11.2015
 * Time: 12:05
 */
namespace MVCFramework;

class FrontController{
    private static $_instance = null;
    /**
     * @var \MVCFramework\Routers\IRouter
     */
    private $router = null;
    private $namespace = null;
    private $controller = null;
    private $method = null;

    private function __construct(){

    }

    /**
     * @return \MVCFramework\FrontController
     */
    public static function getInstance(){
        if(self::$_instance == NULL){
            self::$_instance = new \MVCFramework\FrontController();
        }

        return self::$_instance;
    }

    public function getRouter(){
        return $this->router;
    }

    public function setRouter(\MVCFramework\Routers\DefaultRouter $router){
        $this->router = $router;
    }

    public function dispatch(){
        $this->router = new \MVCFramework\Routers\DefaultRouter();
        if($this->router == NULL){
            throw new \Exception('No valid router found.', 500);
        }

        $_uri = $this->router->getUri();
        var_dump($_uri);

        $_params = explode('/', $_uri);

        // $input = \MVCFramework\InputData::getInstance();

        if($_params[0]){
            $this->controller = strtolower($_params[0]);

            if($_params[1]){
                $this->method = strtolower($_params[1]);
                unset($_params[0], $_params[1]);
                $getParams = array_values($_params);

            } else {
                $this->method = $this->getDefaultMethod();
            }
        } else {
            $this->controller = $this->getDefaultCotroller();
            $this->method = $this->getDefaultMethod();
        }

        echo "Controller: ". $this->controller ."<br/>";
        echo "Method: ". $this-> method ."<br/>";
        echo "Params: ".print_r($getParams)."<br/>";
    }

    public function getDefaultCotroller(){
        $controller = \MVCFramework\App::getInstance()->getConfig()->app['default_controller'];
        if($controller){
            return strtolower($controller);
        }

        return 'home';
    }

    public function getDefaultMethod(){
        $method = \MVCFramework\App::getInstance()->getConfig()->app['default_method'];
        if($method){
            return strtolower($method);
        }

        return 'index';
    }
}
