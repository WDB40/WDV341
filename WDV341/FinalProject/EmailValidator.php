<?php


class EmailValidator
{

    private $MAX_SUBJECT_LENGTH = 25;
    private $MAX_MESSAGE_LENGTH = 100;
    private $MAX_EMAIL_LENGTH = 50;

    public function __construct()
    {

    }

    public function validateSubject($subject){
        $validSubject = true;

        if($this->isEmpty($subject)){
            $validSubject = false;
        } elseif(strlen($subject) > $this->MAX_SUBJECT_LENGTH){
            $validSubject = false;
        }
        return $validSubject;
    }

    public function validateMessage($message){
        $validMessage = true;

        if($this->isEmpty($message)){
            $validMessage = false;
        } elseif(strlen($message) > $this->MAX_MESSAGE_LENGTH){
            $validMessage = false;
        }
        return $validMessage;
    }

    public function validateEmailAddress($email){
        $validEmail = true;

        if($this->isEmpty($email)){
            $validEmail = false;
        } elseif (strlen($email) > $this->MAX_EMAIL_LENGTH){
            $validEmail = false;
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $validEmail = false;
        }

        return $validEmail;
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

?>