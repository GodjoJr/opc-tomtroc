<?php

define('ROOT_URL', dirname(__DIR__));

$requestUri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$assetPath = realpath(__DIR__ . $requestUri);

if ($requestUri !== '/' && $assetPath && is_file($assetPath)) {
    return false;
}

require_once ROOT_URL . '/config/config.php';
require_once ROOT_URL . '/helpers/autoload.php';

 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.dev.css">
</head>
<body>

<?php
$router = new Router();

 ?>
</body>
</html>
