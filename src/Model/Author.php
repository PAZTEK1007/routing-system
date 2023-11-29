<?php

namespace App\Model;

class Author
{
    private $id;
    private $username;
    private $name;
    private $lastname;
    private $picture;
    private $dateOfBirth;
    private $description;

    public function __construct(
        $id,
        $username,
        $name,
        $lastname,
        $picture,
        $dateOfBirth,
        $description,
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->picture = $picture;
        $this->dateOfBirth = $dateOfBirth;
        $this->description = $description;
    }

    // Add getters if needed
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function getDescription()
    {
        return $this->description;
    }

}
