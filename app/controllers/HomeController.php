<?php 

use Core\Controller;
use App\Views\View;

class HomeController extends Controller {
    public function index() {
        $views = new View('TomTroc - Site de troc de livres');
        $views->render('home');
    }
}