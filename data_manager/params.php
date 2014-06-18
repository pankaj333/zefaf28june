<?php

include BASEPATH.'..'.DS.'application'.DS.'config'.DS.'database.php';

$db_params = $db['default'];
define ('DM_DB_HOST', $db_params['hostname']);
define ('DM_DB_NAME', $db_params['database']);
define ('DM_DB_USER', $db_params['username']);
define ('DM_DB_PASS', $db_params['password']);

include BASEPATH.'..'.DS.'application'.DS.'config'.DS.'config.php';

define('DM_BASE_URL', $config['base_url']);	
