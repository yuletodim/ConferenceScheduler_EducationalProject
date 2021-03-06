<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 23.11.2015
 * Time: 12:05
 */
namespace MVCFramework;

class FrontController
{
    private static $_instance = null;
    /**
     * @var \MVCFramework\Routers\IRouter
     */
    private $router = null;
    private $namespace = null;
    private $controller = null;
    private $method = null;
    /**
     * @var \MVCFramework\HttpContext
     */
    private $context = null;

    const CONTROLLERS_SUFFIX = 'Controller';
    const DEFAULT_CONTROLLER = 'home';
    const DEFAULT_METHOD = 'index';

    private function __construct(){
        $this->context = \MVCFramework\HttpContext::getInstance();
    }

    public static function getInstance() : \MVCFramework\FrontController{
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
        if($this->router == NULL){
            throw new \Exception('No valid router found.', 500);
        }

        $_uri = $this->router->getUri();
        if($_uri == NULL){
            $_uri = '/';
        }

        $routes = \MVCFramework\App::getInstance()->getConfig()->routes;

        $_cacheNamespace = [];

        if(is_array($routes) && count($routes) > 0){
            foreach($routes as $key => $value){
                if(stripos($_uri, $key) === 0 &&
                        ($_uri == $key || stripos($_uri, $key.'/') === 0 || $_uri == ucfirst($key)) &&
                        $value['namespace']){
                    $this->namespace = $value['namespace'];
                    echo strlen($key)+1;
                    $_uri = substr($_uri, strlen($key)+1);
                    $_cacheNamespace = $value;
                    break;
                }
            }
        } else {
            throw new \Exception('Default rout is missing.', 500);
        }

        if($this->namespace == NULL && $routes['*']['namespace']){
            $this->namespace = $routes['*']['namespace'];
            $_cacheNamespace = $routes['*'];
        } else if($this->namespace == NULL && !$routes['*']['namespace']) {
            throw new \Exception('Default route is missing.', 500);
        }

        if($_uri == NULL){
            $_uri = '/';
        }

        $_params = explode('/', $_uri);

        if($_params[0]){
            $this->controller = strtolower($_params[0]);

            if($_params[1]){
                $this->method = strtolower($_params[1]);
                unset($_params[0], $_params[1]);

            } else {
                $this->method = $this->getDefaultMethod();
            }
        } else {
            $this->controller = $this->getDefaultCotroller();
            $this->method = $this->getDefaultMethod();
        }

        // check whether the controller has different name than the file
        if(is_array($_cacheNamespace) &&
                $_cacheNamespace['controllers'] &&
                $_cacheNamespace['controllers'][$this->controller]['to']){
            if($_cacheNamespace['controllers'][$this->controller]['methods'][$this->method]){
                $this->method = strtolower($_cacheNamespace['controllers'][$this->controller]['methods'][$this->method]);
            }

            $this->controller = strtolower($_cacheNamespace['controllers'][$this->controller]['to']);
        }

         // echo "Namespace: " . $this->namespace ."<br/>";
         // echo "Controller: ". $this->controller ."<br/>";
         // echo "Method: ". $this-> method ."<br/>";
        // echo "Params: <br/>";
        // print_r($getParams);
        $getParams = array_values($_params);
        $postParams = $this->router->getPost();
        $request = new \MVCFramework\Request($getParams, $postParams);
        $this->context->setRequest($request);
        // echo "Get input: " . print_r($this->context->getRequest()->getGetArray()) . "<br/>";
        // echo "Post input: " . print_r($this->context->getRequest()->getPostArray()) . "<br/>";
        // echo "Cookies input: " . print_r($this->context->getCookiesArray()) . "<br/>";

        $fileController = $this->namespace . '\\' .ucfirst($this->controller) . self::CONTROLLERS_SUFFIX;
        // echo $fileController . '<br/>';
        $currentController = new $fileController();
        $currentController->{$this->method}();
    }

    public function getDefaultCotroller(){
        $controller = \MVCFramework\App::getInstance()->getConfig()->app['default_controller'];
        if($controller){
            return strtolower($controller);
        }

        return self::DEFAULT_CONTROLLER;
    }

    public function getDefaultMethod(){
        $method = \MVCFramework\App::getInstance()->getConfig()->app['default_method'];
        if($method){
            return strtolower($method);
        }

        return self::DEFAULT_METHOD;
    }
}
