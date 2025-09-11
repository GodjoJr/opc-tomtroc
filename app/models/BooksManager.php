<?php
namespace App\Models;

use App\Models\Book;
use Core\ModelManager;
use Core\Error;

class BooksManager extends ModelManager
{
    /**
     * Creates a new book in database
     * @param Book $book book to create
     */
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

    /**
     * Gets all books of a user
     * @param int $user_id the user id
     * @return array the books
     */
    public function getBooksByUserId($user_id)
    {
        $sql = "SELECT * FROM books WHERE b_user_id = :user_id";
        return $this->db->query($sql, ['user_id' => $user_id])->fetchAll();
    }

    /**
     * Gets all books of a user by username
     * @param string $username the user username
     * @return array the books
     */
    public function getBooksByUserUsername($username)
    {
        $sql = "SELECT 
            books.*
            FROM books 
            JOIN users ON books.b_user_id = users.u_id 
            WHERE u_username = :username";
        return $this->db->query($sql, ['username' => $username])->fetchAll();
    }

    /**
     * Gets all books by name
     * @param string $name the book name
     * @return array the books
     */
    public function getBooksByName($name)
    {
        $sql = "SELECT 
            books.*,
            users.*
            FROM books 
            JOIN users ON books.b_user_id = users.u_id 
            WHERE b_title LIKE :name";
        return $this->db->query($sql, ['name' => '%' . $name . '%'])->fetchAll();
    }

    /**
     * Gets all books
     * @return array the books
     */
    public function getAllBooks()
    {
        $sql = "SELECT 
            books.*, 
            users.*
        FROM books
        JOIN users ON books.b_user_id = users.u_id
        ORDER BY b_id DESC";

        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Gets a book by id
     * @param int $id the book id
     * @return Book the book
     */
    public function getBookById($id)
    {
        $sql = "SELECT 
        books.*,
        users.*
        FROM books 
        JOIN users ON books.b_user_id = users.u_id
        WHERE b_id = :id";
        $result = $this->db->query($sql, [
            'id' => $id,
        ]);
        $book = $result->fetch();
        if ($book) {
            return $book;
        }
        return new Error("Le livre n'existe pas.");
    }

    /**
     * Gets the last books
     * @param int $limit the number of books to get
     * @return array the books
     */
    public function getLastBooks($limit)
    {
        $limit = (int) $limit;
        $sql = "SELECT 
        books.*,
        users.*
        FROM books 
        JOIN users ON books.b_user_id = users.u_id
        ORDER BY books.b_created_at DESC
        LIMIT $limit";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Updates a book
     * @param Book $book the book to update
     */
    public function updateBook(Book $book, $id)
    {
        $sql = "UPDATE books SET b_title = :title, b_author = :author, b_description = :description, b_status = :status, b_image = :image WHERE b_id = :id";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'status' => $book->getStatus(),
            'image' => $book->getImage(),
            'id' => $id
        ]);

    }

    public function deleteBook($id)
    {
        $sql = "DELETE FROM books WHERE b_id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
}
