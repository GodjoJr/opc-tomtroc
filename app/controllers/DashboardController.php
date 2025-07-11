<?php

use Core\Controller;
use App\Views\View;

class DashboardController extends Controller
{
    public function profile(string $username)
    {
        if (empty($_SESSION['user'])) {
            header('Location: /auth/login');
            exit;
        }

        if ($_SESSION['user']['username'] !== $username) {
            http_response_code(403);
            echo "Accès interdit.";
            exit;
        }

        $view = new View('Mon profil');
        $view->render('dashboard/profile', [
            'user' => $_SESSION['user']
        ]);
    }
}