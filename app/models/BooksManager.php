<?php
namespace App\Models;

use App\Models\Book;
use Core\ModelManager;
use Core\Error;

class BooksManager extends ModelManager
{
    public function createBook(Book $book)
    {
        $sql = "INSERT INTO books (b_title, b_author, b_description,b_status, b_user_id, b_image) VALUES (:title, :author, :description, :status, :user_id, :image)";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'status' => $book->getStatus(),
            'user_id' => $book->getUserId(),
            'image' => $book->getImage(),
        ]);
    }

    public function getBooksByUserId($user_id)
    {
        $sql = "SELECT * FROM books WHERE b_user_id = :user_id";
        return $this->db->query($sql, ['user_id' => $user_id])->fetchAll();
    }
}
