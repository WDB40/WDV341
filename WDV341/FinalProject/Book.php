<?php

class Book
{
    private $title;
    private $authorLastName;
    private $authorFirstName;
    private $genre;
    private $description;

    public function __construct()
    {

    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getAuthorLastName()
    {
        return $this->authorLastName;
    }

    public function setAuthorLastName($authorLastName)
    {
        $this->authorLastName = $authorLastName;
    }

    public function getAuthorFirstName()
    {
        return $this->authorFirstName;
    }

    public function setAuthorFirstName($authorFirstName)
    {
        $this->authorFirstName = $authorFirstName;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function expose(){
        return get_object_vars($this);
    }
}