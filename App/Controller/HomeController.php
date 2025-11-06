<?php

namespace App\Controller;
class HomeController
{

    public function index(string $view ): void
    {
         include __DIR__ . "/../../templates/template_" . $view . ".php";
    }

    
}