<?php

namespace App\Controller;

use App\Entity\Book;
use App\Service\BookService;
use App\Service\CategoryService;

class BookController{

    private readonly BookService $bookService;
    public function __construct()
    {
        $this->bookService = new BookService();
    }


    public function addBookToUser(): void
    {
        include __DIR__ . "/../../templates/template_register_book.php";

        if (isset($_POST['submit'])) {
            $this->bookService->saveBook(new Book());
        }
    }

    public function showAllBooksUsers(): void
    {
        $books = $this->bookService->getAllBooks();
        include __DIR__ . "/../../templates/template_books_list.php";
    }



}