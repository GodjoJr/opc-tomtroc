<?php
$requestUri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$assetPath = realpath(__DIR__ . $requestUri);

if ($requestUri !== '/' && $assetPath && is_file($assetPath)) {
    return false; // Sert directement les assets (css, js, images)
}

// Ici, tu peux ajouter la gestion des routes contrôleur (exemple ci-dessous)

if ($requestUri === '/' || $requestUri === '/index.php') {
    // on laisse passer vers la page HTML
} else {
    // Pour toute autre route non trouvée, on renvoie 404
    header("HTTP/1.1 404 Not Found");
    echo "404 - Not Found";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.dev.css" />
</head>

<body style="min-width: 1000px; min-height: 1000px;">
    <h1>Bonjour</h1>
    <a href="./index2.html"><p>Lien vers </p>la page 3</a>
</body>

</html>