<?php
session_start();

// Import de l'autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Chargement des variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Analyse de l'URL
$url = parse_url($_SERVER['REQUEST_URI']);
$path = $url['path'] ?? '/';

// Imports des contrôleurs

use App\Controller\BookController;
use App\Controller\HomeController;
use App\Controller\SecurityController;


// Instanciation des contrôleurs
$homeController = new HomeController();
$securityController = new SecurityController();
$bookController =new BookController();


// ROUTER
switch ($path) {

    // Accueil
    case '/':
        $homeController->index('home');
        break;

    // Page d’inscription
    case '/register':
        $securityController->register();
        break;
    // Page de connexion
    case '/login':
        $securityController->connexion();
        break;
    case'/book':
        $bookController->addBookToUser();
        break;
    case'/my-book':
        $bookController->showAllBooksUsers();
    // Déconnexion
    case '/logout':
        session_destroy();
        $securityController->deconnexion();
        break;
    


}