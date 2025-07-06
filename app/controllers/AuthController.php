<?php 

use Core\Controller;
use App\Views\View;

class AuthController extends Controller {

    public function signup() {
        $views = new View('Inscription');
        $views->render('signup');
    }

    public function login() {
        $views = new View('Connexion');
        $views->render('login');
    }

    public function createUser() {
        $views = new View('Inscription');
        $views->render('signup');
    }
}