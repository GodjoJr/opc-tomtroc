<?php

use Core\Controller;
use App\Views\View;
use App\Models\BooksManager;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function profile(string $username)
    {
        $username = urldecode($username);

        if (empty($_SESSION['user'])) {
            header('Location: /auth/login');
            exit;
        }

        if ($_SESSION['user']['username'] !== $username) {
        //TODO : à modifier pour laisser voir les autres profils ($books = getuserbyusername($username))
            http_response_code(403);
            echo "Accès interdit.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('Erreur : jeton CSRF invalide.');
            }

            $uploadDir = 'public/uploads/';
            $publicPath = '/uploads/';
            $imagePath = null;
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['avatar']['tmp_name'];
                $originalName = basename($_FILES['avatar']['name']);
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);

                $safeName = 'avatar_' . $_SESSION['user']['username'] . '_' . time() . '.' . $extension;

                $destination = $uploadDir . $safeName;

                if (move_uploaded_file($tmpName, $destination)) {
                    $imagePath = $publicPath . $safeName;
                } else {
                    //TODO : verfier/modifier
                    new Error('Une erreur est survenue lors de l\'upload de l\'image.');
                }

                $dashboardService = new DashboardService();
                $result = $dashboardService->modifyAvatar($imagePath);

                if ($result['success']) {
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    $_SESSION['user']['avatar'] = $imagePath;
                    $views = new View('Mon profil - ' . $_SESSION['user']['username']);
                    $views->render('dashboard/profile', [
                        'user' => $_SESSION['user'],
                        'errors' => $result['errors'],
                        'old' => $_POST
                    ]);
                    return;
                }
            }

            if (!empty($_POST['email'] || !empty($_POST['password']) || !empty($_POST['username']))) {

                $dashboardService = new DashboardService();
                $result = $dashboardService->modifyUser($_POST);

                if ($result['success']) {
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    $_SESSION['user']['email'] = $_POST['email'];
                    $_SESSION['user']['username'] = $_POST['username'];
                }
            }

            header('Location: /dashboard/profile/' . urlencode($_SESSION['user']['username']));
            exit;
        }

        $books = new BooksManager();
        $_SESSION['user']['books'] = $books->getBooksByUserId($_SESSION['user']['id']);

        $view = new View('Mon profil - ' . $_SESSION['user']['username']);
        $view->render('dashboard/profile', [
            'user' => $_SESSION['user'],
            'books' => $_SESSION['user']['books']
        ]);
    }
}