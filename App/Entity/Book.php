<?php

namespace App\Entity;

use App\Entity\Users;
use App\Entity\Category;

class Book
{
    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $author;
    private ?int $publicationDate;
    private ?Users $user;
    private ?Category $category;
    public function __construct(
        ?int $id = null,
        ?string $description = null,
        ?string $title = null,
        ?string $author = null,
        ?int $publicationDate = null,
        ?Users $user = null,
        ?Category $category = null
    ) {
        $this->id = $id;
        $this->description = $description;
        $this->title = $title;
        $this->author = $author;
        $this->publicationDate = $publicationDate;
        $this->user = $user;
        $this->category = $category;
    }

    //getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getPublicationDate(): ?int
    {
        return $this->publicationDate;
    }
    public function getUser(): ?Users
    {
        return $this->user;
    }
    public function getCategory(): ?Category
    {
        return $this->category;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    //setters
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }
    public function setPublicationDate(int $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    public function setUser(Users $user): void
    {
        $this->user = $user;
    }
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    

}
