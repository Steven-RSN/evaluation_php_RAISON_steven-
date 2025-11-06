<?php

namespace App\Service;
use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryService
{

    private readonly CategoryRepository $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    /**
     * logique metier pour recuperer toutes les categories
     */
    public function getAllCategories(): array
    {
        return $this->categoryRepository->findAll();
    }
}