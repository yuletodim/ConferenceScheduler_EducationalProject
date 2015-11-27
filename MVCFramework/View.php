<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 27.11.2015
 * Time: 11:00
 */
namespace MVCFramework;

class View
{
    private static $_instance = null;
    private $_viewsDirPath = null;
    private $_viewsDir = null;
    private $_viewData = array();
    private $_layoutParts = array();
    private $_layoutData = array();

    const FILE_EXTENSION = '.php';
    const DEFAULT_VIEW_DIR = 'Views';

    private function __construct(){
        $this->_viewsDirPath = \MVCFramework\App::getInstance()->getConfig()->app['views_dir'];
        if($this->_viewsDirPath == NULL){
            $this->_viewsDirPath = realpath(self::DEFAULT_VIEW_DIR);
        }
    }

    public static function getInstance() : \MVCFramework\View{
        if(self::$_instance == NULL){
            self::$_instance = new \MVCFramework\View();
        }

        return self::$_instance;
    }

    public function __set(string $name, $value){
        $this->_viewData[$name] = $value;
    }

    public function __get(string $name){
        return $this->_viewData[$name];
    }

    public function display(string $name, $data = array(), $returnAsString = false){
        if(is_array($data)){
            $this->_viewData = array_merge($this->_viewData, $data);
        }

        if(count($this->_layoutParts) > 0){
            foreach($this->_layoutParts as $key => $value){
                $part = $this->_includeFile($value);
                if($part){
                    $this->_layoutData[$key] = $part;
                }
            }
        }

        if($returnAsString){
            return $this->_includeFile($name);
        } else {
            echo $this->_includeFile($name);
        }
    }

    public function getLayoutData(string $name){
        return $this->_layoutData[$name];
    }

    public function appendToLayout(string $key, string $template){
        if($key && $template){
            $this->_layoutParts[$key] = $template;
        } else {
            throw new \Exception('Layout requires valid key and template.', 500);
        }
    }

    private function _includeFile(string $file){
        if($this->_viewsDir == null){
            $this->setViewsDir($this->_viewsDirPath);
        }

        $_fileName = str_replace('.', DIRECTORY_SEPARATOR, $file);
        $_filePath = $this->_viewsDir . $_fileName . self::FILE_EXTENSION;
        if(file_exists($_filePath) && is_readable($_filePath)){
            ob_start();
            include $_filePath;
            return ob_get_clean();
        }else{
            throw new \Exception('View ' . $file . ' can not be included.', 500);
        }
    }

    // option to set custom view directory
    public function setViewsDir($path){
        $path = trim($path);
        if($path) {
            $path = realpath($path) . DIRECTORY_SEPARATOR;
            if (is_dir($path) && is_readable($path)) {
                $this->_viewsDir = $path;
                echo 'Dir: '.$this->_viewsDir.'<br/>';
            } else {
                throw new \Exception('Invalid path for view directory.', 500);
            }
        } else {
            throw new \Exception('Invalid path for view directory.', 500);
        }
    }
}