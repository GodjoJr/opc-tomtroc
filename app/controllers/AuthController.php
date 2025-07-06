<?php 

use Core\Controller;
use App\Views\View;

class AuthController extends Controller {

    public function signup() {
        //check si le formulaire est envoyé
        //verifier le token CSRF

        //sinon on affiche le formulaire
        $views = new View('Inscription');
        $views->render('signup');
    }

    public function login() {
        $views = new View('Connexion');
        $views->render('login');
    }

    public function createUser() {

    }
}