<?php 
ob_start();
session_start();

// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'twitter');

// App Root 
define('APPROOT', dirname(dirname(__FILE__)));
// URL Root
define('URLROOT', 'http://localhost/twitter');
// Site Name
define('SITENAME', 'Twitter');