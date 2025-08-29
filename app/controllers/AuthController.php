<?php

use App\Services\AuthService;
use Core\Controller;
use App\Views\View;


class AuthController extends Controller
{

    /**
     * Sign up page.
     *
     * If the request method is POST, it validates the form data and register the user.
     * If the registration is successful, it redirects to the login page.
     * If there are errors, it renders the sign up page with the errors and the old data.
     * If the request method is not POST, it renders the sign up page with a new CSRF token.
     *
     * @return void
     */
    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
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

    /**
     * Login page.
     *
     * If the request method is POST, it validates the form data and login the user.
     * If the login is successful, it redirects to the profile page.
     * If there are errors, it renders the login page with the errors and the old data.
     * If the request method is not POST, it renders the login page with a new CSRF token.
     *
     * @return void
     */
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

    /**
     * Logout the user.
     *
     * Destroys the session and redirects to the home page.
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}
