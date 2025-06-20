<?php

define('ROOT_URL', dirname(__DIR__));

$requestUri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($requestUri === '/favicon.ico') {
    http_response_code(204); // Pas de contenu, mais OK
    exit;
}

$assetPath = realpath(__DIR__ . $requestUri);

if ($requestUri !== '/' && $assetPath && is_file($assetPath)) {
    return false;
}

require_once ROOT_URL . '/config/config.php';
require_once ROOT_URL . '/helpers/autoload.php';

$router = new Core\Router();

?>