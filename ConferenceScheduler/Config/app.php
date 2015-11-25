<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 22.11.2015
 * Time: 14:15
 */
$config['default_controller'] = 'Home';
$config['default_method']= 'index';

$config['namespaces']['Controllers'] = 'ConferenceScheduler/Controllers';
$config['namespaces']['Models'] = 'ConferenceScheduler/Models';
$config['namespaces']['Admin\Controllers'] = 'ConferenceScheduler/Admin/Controllers';

$config['session']['autostart'] = true;
$config['session']['type'] = 'native';
$config['session']['name'] = '_sess';
$config['session']['lifetime'] = 3600;
$config['session']['path'] = '/';
$config['session']['domain'] = '';
$config['session']['secure'] = false;
$config['session']['db_connection'] = 'default';
$config['session']['db_table'] = 'session';

$config['display_exceptions'] = false;

return $config;