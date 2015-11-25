<?php
$config['default']['connection_url'] = 'mysql:host=localhost;dbname=conference_scheduler';
$config['default']['username'] = 'root';
$config['default']['password'] = '123456';
$config['default']['pdo_options'][PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'UTF8'";
$config['default']['pdo_options'][PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

return $config;
