<?php

namespace App\Entity;

class Category{
    private ?int $id;
    private ?string $name;

    public function __construct(?int $id = null, ?string $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    //getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    //setters
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}