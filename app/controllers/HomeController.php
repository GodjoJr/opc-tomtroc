<?php 

use Core\Controller;
use App\Views\View;

class HomeController extends Controller {
    public function index() {
        $views = new View('Accueil');
        $views->render('home');
    }
}