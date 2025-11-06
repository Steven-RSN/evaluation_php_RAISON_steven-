<?php

namespace App\Service;

use App\Entity\Book;
use App\Repository\BookRepository;
class BookService{
    private readonly BookRepository $bookRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
    }



    public function saveBook(Book $book): void
    {
        // Logique pour sauvegarder le livre en BDD
          // Récupération des données du formulaire
            $title = $_POST['title'] ?? null;
            $description = $_POST['description'] ?? null;
            $author = $_POST['author'] ?? null;
            $publicationDate = isset($_POST['publication_date']) ? (int)$_POST['publication_date'] : null;

            // Création d'une instance de Book
            $book = new \App\Entity\Book(
                null,
                $description,
                $title,
                $author,
                $publicationDate,
                null,
                null
            );

            // Sauvegarde du livre via le service
         //   $this->bookService->saveBook($book);
    }

    /**
     * logique metier pour récupérer tous les livres
     * @return array (Tableau associatif des livres)
     */
    public function getAllBooks(): array
    {
        return $this->bookRepository->findAll();
    }
}