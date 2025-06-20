<?php 

use Core\Controller;
use App\Views\View;

class TestController extends Controller {
    public function index() {
        $views = new View('Test');
        $views->render('test');
    }
}