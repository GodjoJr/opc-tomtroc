<?php 

use App\Models\BooksManager;
use Core\Controller;
use App\Views\View;

class HomeController extends Controller {
    public function index() {

        $booksManager = new BooksManager();
        $books = $booksManager->getLastBooks(4);

        $views = new View('TomTroc - Site de troc de livres');
        $views->render('home',
        [
            'books' => $books
        ]);
    }
}