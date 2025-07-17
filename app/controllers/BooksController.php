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
                    echo "Erreur lors de l'envoi du fichier.";
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
}