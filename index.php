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

//var_dump($app->getDbConnection());


//$config = \MVCFramework\Config::getInstance();
//$config->setConfigFolder('ConferenceScheduler/Config');
//
//\MVCFramework\Loader::registerNamespace('Test\Models',
//    'ConferenceScheduler\Models');

//$db = new \MVCFramework\Database();
//$stmt = $db->prepare('SELECT * FROM users');
//$stmt->execute();
//print_r($stmt->fetchAllAssoc());
//echo '<br/>';
//
//$stmt_2 = $db->prepare('SELECT name, age FROM users WHERE id=?');
//$stmt_2->execute(array(1));
//print_r($stmt_2->fetchRowAssoc());
//echo '<br/>';

//$app->getSession()->counter+=1;
//echo $app->getSession()->counter;
