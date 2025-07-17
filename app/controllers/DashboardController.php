<?php

use Core\Controller;
use App\Views\View;
use App\Models\BooksManager;

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

        $books = new BooksManager();
        $_SESSION['user']['books'] = $books->getBooksByUserId($_SESSION['user']['id']);

        $view = new View('Mon profil');
        $view->render('dashboard/profile', [
            'user' => $_SESSION['user'],
            'books' => $_SESSION['user']['books']
        ]);
    }
}