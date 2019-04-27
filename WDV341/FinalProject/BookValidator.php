<?php

class BookValidator
{

    private $MAX_NAME_LENGTH = 25;
    private $MAX_TITLE_LENGTH = 50;
    private $MAX_GENRE_LENGTH = 25;
    private $MAX_DESC_LENGTH = 100;

    public function __construct()
    {
    }

    public function validateName($name){
        $validName = true;

        if($this->isEmpty($name)){
            $validName = false;
        } elseif(strlen($name) > $this->MAX_NAME_LENGTH){
            $validName = false;
        }
        return $validName;
    }

    public function validateGenre($genre){
        $validGenre = true;

        if($this->isEmpty($genre)){
            $validGenre = false;
        } elseif(strlen($genre) > $this->MAX_GENRE_LENGTH){
            $validGenre = false;
        }

        return $validGenre;
    }

    public function validateDesc($desc){
        $validDesc = true;

        if($this->isEmpty($desc)){
            $validDesc = false;
        } elseif(strlen($desc) > $this->MAX_DESC_LENGTH){
            $validDesc = false;
        }
        return $validDesc;
    }

    public function validateTitle($title){
        $validTitle = true;

        if($this->isEmpty($title)){
            $validTitle = false;
        } elseif (strlen($title) > $this->MAX_TITLE_LENGTH){
            $validTitle = false;
        }
        return $validTitle;
    }

    public function isEmpty($input){
        $emptyString = false;
        $trimmedInput = trim($input);

        if(empty($trimmedInput)){
            $emptyString = true;
        }
        return $emptyString;
    }
}