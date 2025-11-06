<?php

namespace App\Service;

use App\Entity\Users;
use App\Repository\UsersRepository;

class SecurityService
{
    private readonly UsersRepository $usersRepository;

    public function __construct()
    {
        $this->usersRepository = new UsersRepository();
    }



    /**
     * logique metier pour l'inscription d'un utilisateur
     * @param Users $user (Objet User à inscrire)
     * @return void qui ne retourne rien
     */

    public function register(Users $user): void
    {
        // Validation des champ
        if (empty($_POST['email']) || empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['password'])) {
            echo "Veuillez remplir tous les champs.";
            return;
        }

        // Validation de email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "L'adresse e-mail n'est pas valide.";
            return;
        }


        // Validation mot de passe
        if ($_POST['password'] !== $_POST['confirmPassword']) {
            echo "Les mots de passe ne correspondent pas.";
            return;
        }

        // Sanitize les inputs
        $firstname = \App\Utils\Tools::sanitize($_POST['firstname']);
        $lastname = \App\Utils\Tools::sanitize($_POST['lastname']);
        $email = \App\Utils\Tools::sanitize($_POST['email']);

        //verifier si l'email existe deja en bdd
        $existingUser = $this->usersRepository->findUserByEmail($_POST['email']);
        if ($existingUser) {
            echo "L'adresse e-mail est déjà utilisée.";
            return;
        }

        $user = new Users();

        $user->hashPassword($_POST['password']);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setEmail($email);
        $user->setPassword($_POST['password']);

        // Sauvegarde en BDD
        $this->usersRepository->saveUser($user);

        // redirection apres inscription | Utile ??
        //header('Location: /');
        exit();
    }


    /**
     * logique metier pour la connexion d'un utilisateur
     * @param Users $user (Objet User à connecter)  
     */
    public function connexion(Users $user): void
    {
        // Validation des champ
        if (empty($_POST['email']) || empty($_POST['password'])) {
            echo "Veuillez remplir tous les champs.";
            return;
        }

        //netoyer les inputs
        $email = \App\Utils\Tools::sanitize($_POST['email']);

        // Verifier si l'email existe en bdd
        $existingUser = $this->usersRepository->findUserByEmail($_POST['email']);
        if (!$existingUser) {
            echo "Email ou mot de passe incorrect.";
            return;
        }


        // verification mot de passe 
        if (!$existingUser->passwordVerify($_POST['password'])) {
            echo "Email ou mot de passe incorrect.";
            return;
        }
        //  dd($existingUser);


        $_SESSION['id'] = $existingUser->getId();
        $_SESSION['email'] = $existingUser->getEmail();
        $_SESSION['firstname'] = $existingUser->getFirstname();
        $_SESSION['lastname'] = $existingUser->getLastname();


        // redirection apres connexion !
        header('Location: /');
        exit();
    }


    /**
     * logique metier pour la deconnexion d'un utilisateur
     */
    public function logout(): void
    {
        session_destroy();

        // redirection apres deconnexion
        header('Location: /login');
        exit();
    }
}
