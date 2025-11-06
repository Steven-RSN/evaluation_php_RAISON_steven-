<?php

namespace App\Entity;

class Users{

    
    private ?int $id;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $email;
    private ?string $password;

    public function __construct(
        ?int $id =null, 
        ?string $firstname=null,
        ?string $lastname=null,
        ?string $email=null,
        ?string $password=null
    )
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;        
        $this->email = $email;
        $this->password = $password;
    }



    // Getters :

    public function getId(): ?int {
        return $this->id;
    }   
    public function getFirstname(): ?string {
        return $this->firstname;
    }
    public function getLastname(): ?string {
        return $this->lastname;
    }
    public function getEmail(): ?string {
        return $this->email;
    }
    public function getPassword(): ?string {
        return $this->password;
    }


    // Setters:

    public function setId(int $id): void {
        $this->id = $id;
    }
    public function setFirstname(string $firstname): void {
        $this->firstname = $firstname;
    }
    public function setLastname(string $lastname): void {
        $this->lastname = $lastname;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }   
    public function setPassword(string $password): void {
        $this->password = $password;
    }

    //Method : 

    /**
     * Hash le mot de passe de l'utilisateur
     * @return void
     */
    public function hashPassword(): void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    /**
     * Vérifie si le mot de passe correspond au hash stocké
     * @param string $inputPassword (Mot de passe à vérifier)
     * @return bool (true si mot de passe correct)
     */
    public function passwordVerify(string $inputPassword): bool {
        return password_verify($inputPassword, $this->password);
    }



}
