<?php

use App\Models\BooksManager;
use App\Models\Book;
use Core\Controller;
use App\Views\View;

class BooksController extends Controller
{
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //TODO : ajouter des checks
            $title = $_POST['title'] ?? '';
            $author = $_POST['author'] ?? '';
            $commentary = $_POST['commentary'] ?? '';
            $availaibility = $_POST['availaibility'] ?? 'unavailable';

            $uploadDir = 'public/uploads/';
            $publicPath = '/uploads/';
            $imagePath = null;

            if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['cover']['tmp_name'];
                $originalName = basename($_FILES['cover']['name']);
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);

                $safeName = 'book_' . $_SESSION['user']['username'] . '_' . time() . '.' . $extension;

                $destination = $uploadDir . $safeName;

                if (move_uploaded_file($tmpName, $destination)) {
                    $imagePath = $publicPath . $safeName;
                } else {
                    //TODO : verfier/modifier
                    new Error('Une erreur est survenue lors de l\'upload de l\'image.');
                }
            }


            $book = (new Book())
                ->setUserId($_SESSION['user']['id'])
                ->setTitle($title)
                ->setAuthor($author)
                ->setDescription($commentary)
                ->setStatus($availaibility)
                ->setImage($imagePath);

            $booksManager = new BooksManager();
            $booksManager->createBook($book);

            header('Location: /dashboard/profile/' . $_SESSION['user']['username']);
        } else {


            $views = new View('Ajouter un livre');
            $views->render('books/create');
        }
    }

    public function archive()
    {

        $booksManager = new BooksManager();
        $books = $booksManager->getAllBooks();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérif CSRF

            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('Erreur : jeton CSRF invalide.');
            }

            if (isset($_POST['search'])) {
                $books = $booksManager->getBooksByName($_POST['search']);
            }
        }

        $views = new View('Nos livres à l\'échange');
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $views->render(
            'books/archive',
            [
                'books' => $books
            ]
        );
    }

    public function detail($id)
    {
        $booksManager = new BooksManager();
        $book = $booksManager->getBookById($id);
        
        $views = new View('Detail du livre');
        $views->render(
            'books/detail',
            [
                'book' => $book
            ]
        );
    }
}