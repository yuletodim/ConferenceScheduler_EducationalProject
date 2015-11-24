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

        if($this->router == NULL){
            throw new \Exception('No valid router found.', 500);
        }

        $_uri = $this->router->getUri();
        echo 'Uri: ' . $_uri . '<br/>';

        $routes = \MVCFramework\App::getInstance()->getConfig()->routes;

        $_cacheNamespace = [];

        if(is_array($routes) && count($routes) > 0){
            foreach($routes as $key => $value){
                if(stripos($_uri, $key) === 0 &&
                        ($_uri == $key || stripos($_uri, $key.'/') === 0) &&
                        $value['namespace']){
                    $this->namespace = $value['namespace'];
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
            throw new \Exception('default route is missing.', 500);
        }

        $_params = explode('/', $_uri);

        // $input = \MVCFramework\InputData::getInstance();

        if($_params[0]){
            $this->controller = strtolower($_params[0]);

            if($_params[1]){
                $this->method = strtolower($_params[1]);
                unset($_params[0], $_params[1]);
                $getParams = array_values($_params);
                // $input->setGet($getParams);
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

        echo "Namespace: " . $this->namespace ."<br/>";
        echo "Controller: ". $this->controller ."<br/>";
        echo "Method: ". $this-> method ."<br/>";
        echo "Params: <br/>";
        print_r($getParams);

        // $input->setPost($this->router->getPost());

        $fileController = $this->namespace . '\\' .ucfirst($this->controller) . 'Controller';
        echo $fileController . '<br/>';
        $currentController = new $fileController();
        $currentController->{$this->method}();

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
