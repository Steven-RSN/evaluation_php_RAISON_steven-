<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Book;

class BookRepository
{

    protected \PDO $connexion;

    public function __construct()
    {
        $this->connexion = (new Mysql())->connexion();
    }



    //Methodes :

    /**
     * Méthode pour récupérer tous les livres en BDD
     * @return array (Tableau associatif des livres)
     */
    public function findAll(): array
    {
        $request = "SELECT id_book, title, author, publication_date, `description` FROM books";

        $req = $this->connexion->prepare($request);

        $req->execute();

        $booksData = $req->fetchAll();

        return $booksData;
    }

    /**
     * Méthode pour récupérer un livre en BDD via son id
     * @param int $id (Identifiant du livre à récupérer)
     * @return array|null (Objet Book ou null si non trouvé)
     * 
     */
    public function find(int $id): ?array
    {
        $request = "SELECT id_book, title, author, publication_date, `description` FROM books WHERE id_book = ?";

        $req = $this->connexion->prepare($request);

        $req->bindValue(1, $id, \PDO::PARAM_INT);

        $req->execute();

        $bookData = $req->fetch();

        return $bookData ?: null;
    }


    /**
     * Méthode pour enregistrer un livre en BDD
     * @param Book $book (Objet Book à ajouter en BDD)
     * @return void qui ne retourne rien
     */
    public function saveBook(Book $book): void
    {

        $request = "INSERT INTO books (title, author,publication_date,author,id_category,id_users ) VALUES (?, ?, ?, ?, ?, ?)";

        $req = $this->connexion->prepare($request);

        $req->bindValue(1, $book->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(2, $book->getAuthor(), \PDO::PARAM_STR);
        $req->bindValue(3, $book->getPublicationDate(), \PDO::PARAM_INT);
        $req->bindValue(4, $book->getDescription(), \PDO::PARAM_STR);
       // $req->bindValue(5, $book->getCategory()->getId(), \PDO::PARAM_INT); //A VOIR AVEC CATEGORY
        $req->bindValue(6, $book->getUser()->getId(), \PDO::PARAM_INT);
        

        $req->execute();
    }


    /**
     * Méthode pour mettre à jour un livre en BDD
     * @param Book $book (Objet Book à mettre à jour en BDD)
     * @return void
     * 
     */
    public function UPDATEBook(Book $book): void
    {
        $request = "UPDATE books SET title = ?, author = ?, publication_date = ?, `description` = ? WHERE id_book = ?";

        $req = $this->connexion->prepare($request);

        $req->bindValue(1, $book->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(2, $book->getAuthor(), \PDO::PARAM_STR);
        $req->bindValue(3, $book->getPublicationDate(), \PDO::PARAM_INT);
        $req->bindValue(4, $book->getDescription(), \PDO::PARAM_STR);
        $req->bindValue(5, $book->getId(), \PDO::PARAM_INT);

        $req->execute();
    }


    /**
     * Méthode pour supprimer un livre en BDD via son id
     * @param int $id (Identifiant du livre à supprimer)
     * @return void
     * 
     */
    public function deleteBook(int $id): void
    {
        $request = "DELETE FROM books WHERE id_book = ?";

        $req = $this->connexion->prepare($request);

        $req->bindValue(1, $id, \PDO::PARAM_INT);

        $req->execute();
    }
}
