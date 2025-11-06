<?php

namespace App\Repository;

use App\Entity\Users;
use App\Database\Mysql;

class UsersRepository
{

    protected \PDO $connexion;

    public function __construct()
    {
        $this->connexion = (new Mysql())->connexion();
    }

    /**
     * Méthode pour enregistrer un utilisateur en BDD
     * @param User $user (Objet User à ajouter en BDD)
     * @return void qui ne retourne rien
     */

    public function saveUser(Users $user): void
    {

        $request = "INSERT INTO users (firstname, lastname, email, `password`) VALUES (?, ?, ?, ?)";

        $req = $this->connexion->prepare($request);

        $req->bindValue(1, $user->getFirstname(), \PDO::PARAM_STR);
        $req->bindValue(2, $user->getLastname(), \PDO::PARAM_STR);
        $req->bindValue(3, $user->getEmail(), \PDO::PARAM_STR);
        $req->bindValue(4, $user->getPassword(), \PDO::PARAM_STR);

        $req->execute();
    }


    /**
     * Méthode pour récupérer un utilisateur en BDD via son id
     * @param int $id (Identifiant de l'utilisateur à récupérer)
     * @return User|null (Objet User ou null si non trouvé)
     * 
     */
    public function find(int $id): null|Users
    {
        $request = 'SELECT firstname, lastname, email, `password` FROM users WHERE id= ?';

        $req = $this->connexion->prepare($request);

        $req->bindParam(1, $id, \PDO::PARAM_INT);
        $req->execute();
        $user = $req->fetch();

        if (!$user) {
            return null;
        }

        return $user;
    }

    /**
     * Méthode pour récupérer tous les utilisateurs en BDD
     * @return array (Tableau des utilisateurs)
     */
    public function findAll(): array
    {
        $request = 'SELECT id_users, firstname, lastname, email, `password` FROM users';

        $req = $this->connexion->prepare($request);
        $req->execute();
        $usersTabAssoc = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $usersTabAssoc;
    }

    /**
     * Méthode pour récupérer un utilisateur en BDD via son email
     * @param string $email (Email de l'utilisateur à récupérer)
     * @return User|null (Objet User ou null si c'est non trouvé)
     * 
     */
    public function findUserByEmail(string $email): null|Users
    {
        $request = 'SELECT id_users, firstname, lastname, email, `password` FROM users WHERE email= ?';

        $req = $this->connexion->prepare($request);

        $req->bindValue(1, $email, \PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetch(\PDO::FETCH_ASSOC);
        //dd($result);
        if ($result) {
            $user= new Users(
                id: $result['id_users'],
                firstname: $result['firstname'],
                lastname: $result['lastname'],
                email: $result['email'],
                password: $result['password']
            );
            return $user;
        }

        return null;
    }


    /**
     * Méthode pour vérifier si un utilisateur existe en BDD via son email
     * @param string $email (Email de l'utilisateur à vérifier)
     * @return bool (true si l'utilisateur existe, sinon false)
     * 
     */
    public function isUserExist(string $email): bool
    {
        $request = 'SELECT id_users FROM users WHERE email= ?';

        $req = $this->connexion->prepare($request);

        $req->bindParam(1, $email, \PDO::PARAM_STR);
        $req->execute();
        return $req->fetch(\PDO::FETCH_ASSOC);
    }


    /**
     * Méthode pour mettre à jour un utilisateur en BDD
     * @param User $user (Objet User à mettre à jour en BDD)
     * @return void qui ne retourne rien
     */
    public function updateUser(Users $user): void
    {
        $request = "UPDATE users SET firstname = ?, lastname = ?, email = ?, `password` = ? WHERE id = ?";

        $req = $this->connexion->prepare($request);

        $req->bindParam(1, $user->getFirstname(), \PDO::PARAM_STR);
        $req->bindParam(2, $user->getLastname(), \PDO::PARAM_STR);
        $req->bindParam(3, $user->getEmail(), \PDO::PARAM_STR);
        $req->bindParam(4, $user->getPassword(), \PDO::PARAM_STR);
        $req->bindParam(5, $user->getId(), \PDO::PARAM_INT);

        $req->execute();
    }

    /**
     * Méthode qui supprime un utilisateur en BDD via son id
     * @param int $id (id de l'utilisateur à supprimer)
     * @return void qui ne retourne rien
     */
    public function deleteUser(int $id): void
    {
        $request = "DELETE FROM users WHERE id = ?";

        $req = $this->connexion->prepare($request);

        $req->bindParam(1, $id, \PDO::PARAM_INT);

        $req->execute();
    }
}
