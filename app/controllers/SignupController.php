<?php 

use Core\Controller;
use App\Views\View;

class SignupController extends Controller {
    public function index() {
        $views = new View('Inscription');
        $views->render('signup');
    }
}