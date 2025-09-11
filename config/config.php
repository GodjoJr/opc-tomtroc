<?php

session_start();

date_default_timezone_set('Europe/Paris');

define('TEMPLATE_VIEW_PATH', ROOT_URL . '/app/views/templates/');
define('MAIN_VIEW_PATH', TEMPLATE_VIEW_PATH . 'main.php');

define('DB_HOST', '127.0.0.1:8889');
define('DB_NAME', 'opc_tomtroc');
define('DB_USER', 'root');
define('DB_PASS', 'root');
