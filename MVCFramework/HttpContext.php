<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 24.11.2015
 * Time: 18:08
 */
namespace MVCFramework;

class HttpContext
{
    private static $_instance = null;

    /**
     * @var \MVCFramework\Request
     */
    private $_request = null;

    /**
     * @var \MVCFramework\IdentitySystem\CurrentUser
     */
    private $_user = null;

    /**
     * @var \MVCFramework\Sessions\ISession
     */
    private $_session = null;
    private $_cookies = array();

    private function __construct(){
        $this->_cookies = $_COOKIE;
    }

    public static function getInstance() : \MVCFramework\HttpContext{
        if(self::$_instance == NULL){
            self::$_instance = new \MVCFramework\HttpContext();
        }

        return self::$_instance;
    }

    public function setRequest(\MVCFramework\Request $request){
        $this->_request = $request;
    }

    public function getRequest() : \MVCFramework\Request{
        return $this->_request;
    }

    public function getSession() : \MVCFramework\Sessions\ISession{
        return $this->_session;
    }

    public function setUser(\MVCFramework\IdentitySystem\CurrentUser $user){
        $this->_user = $user;
    }

    public function getUser() : \MVCFramework\IdentitySystem\CurrentUser{
        return $this->_user;

    }

    public function isLogged(){
        return $this->_session;
    }

    public function setSession(){
        // start session
        $_sess = \MVCFramework\App::getInstance()->getConfig()->app['session'];
        if($_sess['autostart']) {
            if ($_sess['type'] == 'native') {
                $session = new \MVCFramework\Sessions\NativeSession(
                    $_sess['name'],
                    $_sess['lifetime'],
                    $_sess['path'],
                    $_sess['domain'],
                    $_sess['secure']
                );

                $this->_session  = $session;
                echo print_r($this->_session) . '<br/>';
            } else if ($_sess['type'] == 'database') {
                $session = new \MVCFramework\Sessions\DBSession(
                    $_sess['db_connection'],
                    $_sess['name'],
                    $_sess['db_table'],
                    $_sess['lifetime'],
                    $_sess['path'],
                    $_sess['domain'],
                    $_sess['secure']
                );

                $this->_session  = $session;
            } else {
                throw new \Exception('No valid session.', 500);
            }
        }
    }

    public function hasCookieValue(string $name) : bool{
        return array_key_exists($name, $this->_cookies);
    }

    public function getCookiesArray() : array{
        return $this->_cookies;
    }

    public function getCookies(string $name, string $normalize = null, $defaultValue = null){
        if($this->hasCookieValue($name)){
            if($normalize != NULL){
                return \MVCFramework\Utilities::normalize($this->_cookies[$name], $normalize);
            }

            return $this->_cookies[$name];
        }

        return $defaultValue;
    }
}