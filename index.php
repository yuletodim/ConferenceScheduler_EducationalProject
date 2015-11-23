<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 20.11.2015
 * Time: 21:38
 */
ini_set('display_errors', 1);

include 'MVCFramework/App.php';

$app = MVCFramework\App::getInstance();
$app->run();


//$config = \MVCFramework\Config::getInstance();
//$config->setConfigFolder('ConferenceScheduler/Config');
//
//\MVCFramework\Loader::registerNamespace('Test\Models',
//    'ConferenceScheduler\Models');