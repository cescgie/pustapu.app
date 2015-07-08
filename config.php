<?php

//set timezone
date_default_timezone_set('Europe/Berlin');

//site address
define('DIR','http://localhost/adsi/');
define('DOCROOT', dirname(__FILE__));

// Credentials for the local server
define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','kapau');
define('DB_USER','root');
define('DB_PASS','');

//set prefix for sessions
define('SESSION_PREFIX','kapau_');

//optionall create a constant for the name of the site
define('SITETITLE','Kapau');