<?php

namespace Core;

use Core\Controller;
use Core\Error;
use App\Models\MessageManager;

/**
 * Classe de routeur pour gérer les requêtes HTTP.
 */
class Router
{

    protected Controller $controller;
    protected string $method = 'index';
    protected array $params = [];

    public function __construct()
    {

        $this->checkUnreadMessages();

        // Analyse de l'URL
        $url = $this->parseUrl();

        // Contrôleur par défaut
        $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
        $controllerPath = ROOT_URL . '/app/controllers/' . $controllerName . '.php';

        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            $this->controller = new $controllerName;
            unset($url[0]);
        } else {
            $this->handleNotFound("Le contrôleur \"$controllerName\" n'existe pas.");
        }

        // Méthode du contrôleur
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        } elseif (isset($url[1])) {
            $this->handleNotFound("La méthode \"{$url[1]}\" n'existe pas dans le contrôleur.");
        }

        // Paramètres supplémentaires
        $this->params = $url ? array_values($url) : [];

        // Appel du contrôleur->methode->params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Analyse l'URL pour extraire les parties dans un tableau.
     *
     * @return array
     */
    private function parseUrl(): array
    {
        $url = isset($_GET['url']) ? $_GET['url'] : $_SERVER['REQUEST_URI'];

        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        } else if (trim($_SERVER['REQUEST_URI'], '/')) {
            return explode('/', filter_var(trim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    /**
     * Gère les erreurs 404.
     *
     * @param string $message
     */
    private function handleNotFound(string $message): void
    {
        http_response_code(404);

        new Error($message);

        // Afficher une page d’erreur simple à l’utilisateur

        echo "<h1>404 - Page non trouvée</h1>";
        echo "<p>Une erreur est survenue. Elle a été enregistrée.</p>";
        echo "<a href='/'>Retour à la page d'accueil</a>";


        exit;
    }

    private function checkUnreadMessages(): void
    {

        if(!isset($_SESSION['user']) || !$_SESSION['user']) {
            return;
        }
        $messageManager = new MessageManager();
        $count = $messageManager->countUnreadMessages($_SESSION['user']['id']);
        $_SESSION['user']['unreadMessages'] = $count;

    }

}

