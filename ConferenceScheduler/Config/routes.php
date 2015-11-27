<?php
// Define a namespace
$config['admin']['namespace'] = 'admin\Controllers';

// Override controller
$config['admin']['controllers']['home2']['to'] = 'adminHome';

// Override method
$config['admin']['controllers']['home2']['methods']['index2'] = 'adminIndex';

// The most common case is last
$config['*']['namespace'] = 'Controllers';

return $config;