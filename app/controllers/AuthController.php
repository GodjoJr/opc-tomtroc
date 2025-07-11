<?php

use App\Services\AuthService;
use Core\Controller;
use App\Views\View;

class AuthController extends Controller
{

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérif CSRF
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('Erreur : jeton CSRF invalide.');
            }

            $authService = new AuthService();
            $result = $authService->register($_POST);

            if (!$result['success']) {
                $views = new View('Inscription');
                $views->render('signup', [
                    'errors' => $result['errors'],
                    'old' => $_POST
                ]);
                return;
            }

            header('Location: /auth/login');
            exit;
        }

        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $views = new View('Inscription');
        $views->render('signup');
    }

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authService = new AuthService();
            $result = $authService->login($_POST);

            if ($result['success']) {
                header('Location: /dashboard/profile/' . $_SESSION['user']['username']);
                exit;
            }

            $views = new View('Connexion');
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $views->render('login', [
                'errors' => $result['errors'],
                'old' => $_POST,
            ]);
            return;
        }

        $views = new View('Connexion');
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $views->render('login');
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}