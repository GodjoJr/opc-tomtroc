<?php 

use Core\Controller;
use App\Views\View;

class SigninController extends Controller {
    public function index() {
        $views = new View('Inscription');
        $views->render('signin');
    }
}