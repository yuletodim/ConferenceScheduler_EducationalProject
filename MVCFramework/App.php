<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 21.11.2015
 * Time: 21:09
 */
namespace MVCFramework;

include_once 'Loader.php';

class App{
    private static $_instance = null;

    /**
     * @var \MVCFramework\Config
     */
    private $_config = null;

    /**
     * @var \MVCFramework\FrontController
     */
    private $_frontController = null;
    private $_router;
    private $_dbConnections = array();
    private $_session = null;

    private function __construct(){
        \MVCFramework\Loader::registerNamespace('MVCFramework', dirname(__FILE__) . DIRECTORY_SEPARATOR);
        \MVCFramework\Loader::registerAutoload();
        $this->_config = \MVCFramework\Config::getInstance();
    }

    /**
     * @return \MVCFramework\App
     */
    public static function getInstance(){
        if(self::$_instance == NULL){
            self::$_instance = new \MVCFramework\App();
        }

        return self::$_instance;
    }

    /**
     * @return \MVCFramework\Config
     */
    public function getConfig(){
        return $this->_config;
    }

    public function setConfigFolder(string $path){
        $this->_config->setConfigFolder($path);
    }

    public function getConfigFolder(){
        return $this->_configFolder;
    }

    public function getSession():\MVCFramework\Sessions\ISession{
        return $this->_session;
    }
    // option to set custom session
    public function setSession(\MVCFramework\Sessions\ISession $session){
        $this->_session = $session;
    }

    public function run(){
        // if config folder is not set use default one
        if($this->_config->getConfigFolder() == NULL){
            $this->setConfigFolder('ConferenceScheduler/Config');
        }
        // start session
        $_sess = $this->_config->app['session'];
        if($_sess['autostart']) {
            if ($_sess['type'] == 'native') {
                $_session = new \MVCFramework\Sessions\NativeSession(
                    $_sess['name'],
                    $_sess['lifetime'],
                    $_sess['path'],
                    $_sess['domain'],
                    $_sess['secure']
                );

                $this->setSession($_session);
//            } else if ($_sess['type'] == 'database') {
//                $_session = new \MVCFramework\Sessions\DBSession(
//                    $_sess['db_connection'],
//                    $_sess['name'],
//                    $_sess['db_table'],
//                    $_sess['lifetime'],
//                    $_sess['path'],
//                    $_sess['domain'],
//                    $_sess['secure']
//                );
//
//                $this->setSession($_session);
            } else {
                throw new \Exception('No valid session.', 500);
            }
        }

        // instantiate FrontController
        $this->_frontController = \MVCFramework\FrontController::getInstance();
        if($this->_router instanceof \MVCFramework\Routers\IRouter){
            $this->_frontController->setRouter($this->_router);
        } else {
            $this->_frontController->setRouter(new \MVCFramework\Routers\DefaultRouter());
        }
        $this->_frontController->dispatch();
    }

    public function getDbConnection(string $connection = 'default'){
        if(!$connection){
            throw new \Exception('No connection identifier provided.', 500);
        }

        if($this->_dbConnections[$connection]){
            return $this->_dbConnections[$connection];
        }

        $_dbConfig = $this->getConfig()->database;
        if(!$_dbConfig[$connection]){
            throw new \Exception('No connection identifier provided.', 500);
        }

        $dsn = $_dbConfig[$connection]['connection_url'];
        $user = $_dbConfig[$connection]['username'];
        $pass = $_dbConfig[$connection]['password'];
        $options = $_dbConfig[$connection]['pdo_options'];

        $pdo = new \PDO($dsn, $user, $pass, $options);
        $this->_dbConnections[$connection] = $pdo;

        return $this->_dbConnections[$connection];
    }
}
