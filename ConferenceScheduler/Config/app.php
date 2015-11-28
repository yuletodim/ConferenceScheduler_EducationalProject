<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 22.11.2015
 * Time: 14:15
 */
$config['app_name'] = 'ConferenceScheduler_EducationalProject';
$config['default_controller'] = 'Home';
$config['default_method']= 'index';

$config['namespaces']['Controllers'] = 'ConferenceScheduler/Controllers';
$config['namespaces']['Models'] = 'ConferenceScheduler/Models';
$config['namespaces']['Admin\Controllers'] = 'ConferenceScheduler/Admin/Controllers';

$config['session']['autostart'] = true;
$config['session']['type'] = 'database';
$config['session']['name'] = '_sess';
$config['session']['lifetime'] = 3600;
$config['session']['path'] = '/';
$config['session']['domain'] = '';
$config['session']['secure'] = false;
$config['session']['db_connection'] = 'default';
$config['session']['db_table'] = 'sessions';

$config['views_dir'] = 'ConferenceScheduler/Views';

$config['display_exceptions'] = false;

return $config;