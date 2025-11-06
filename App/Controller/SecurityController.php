<?php

namespace App\Controller;

use App\Entity\Users;
use App\Service\SecurityService;



class SecurityController
{

    private readonly SecurityService $securityService;

    public function __construct()
    {
        $this->securityService = new SecurityService();
    }

    public function render(string $view, array $params = []): void
    {
        include __DIR__ . "/../../templates/template_" . $view . ".php";
    }


    public function register(): void
    {
        $this->render('register');

        if (isset($_POST['submit'])) {

            $this->securityService->register(new Users());
        }
    }

    public function connexion(){
        $this->render('login');
        if (isset($_POST['submit'])) {
            $this->securityService->connexion(new Users());
        }
    }

    public function deconnexion(){
        $this->securityService->logout();

    }


}
