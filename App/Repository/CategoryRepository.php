<?php

namespace App\Repository;

use App\Entity\Category;
use App\Database\Mysql;


class CategoryRepository
{
    protected \PDO $connexion;

    public function __construct()
    {
        $this->connexion = (new Mysql())->connexion();
    }

    public function saveCategory(Category $category): void
    {
        $requet = 'INSERT INTO category (`name`) VALUES (?)';

        $req = $this->connexion->prepare($requet);

        $req->bindValue(1, $category->getName(), \PDO::PARAM_STR);
        $req->execute();
    }

    public function findAll(): array
    {
        $request = 'SELECT id_category, `name` FROM category';

        $req = $this->connexion->prepare($request);

        $req->execute();

        $categoriesData = $req->fetchAll();

        return $categoriesData;
    }

    public function find(int $id): ?Category
    {
        $request = 'SELECT id_category, `name` FROM category WHERE id_category = ?';

        $req = $this->connexion->prepare($request);

        $req->bindValue(1, $id, \PDO::PARAM_INT);

        $req->execute();

        $categoryData = $req->fetch();

        return $categoryData ?: null;
    }

    public function updateCategory(Category $category): void
    {
        $request = 'UPDATE category SET `name` = ? WHERE id_category = ?';

        $req = $this->connexion->prepare($request);

        $req->bindValue(1, $category->getName(), \PDO::PARAM_STR);
        $req->bindValue(2, $category->getId(), \PDO::PARAM_INT);

        $req->execute();
    }

    public function deleteCategory(int $id): void
    {
        $request = 'DELETE FROM category WHERE id_category = ?';

        $req = $this->connexion->prepare($request);

        $req->bindValue(1, $id, \PDO::PARAM_INT);

        $req->execute();
    }
}
