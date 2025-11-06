<?php
namespace App\Controller;

use App\Service\CategoryService;

class CategoryController{
    private readonly CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService =new CategoryService;
        
    }

    /**
     * 
     */
    public function showAllCategory():void{

    }

    

}