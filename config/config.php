<?php

session_start();

date_default_timezone_set('Europe/Paris');

define('TEMPLATE_VIEW_PATH', ROOT_URL . '/app/views/templates/');
define('MAIN_VIEW_PATH', TEMPLATE_VIEW_PATH . 'main.php');

define('DB_HOST', '');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');
