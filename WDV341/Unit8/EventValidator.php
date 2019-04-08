<?php

class EventValidator
{
    private $DATE_LENGTH = 8;
    private $TIME_LENGTH = 6;

    public function __construct(){

    }

    public function validateText($text){
        $validText = true;

        if($this->isEmpty($text)) {
            $validText = false;
        }

        return $validText;
    }

    private function isEmpty($input){
        $emptyString = false;

        $trimmedInput = trim($input);

        if(empty($trimmedInput)){
            $emptyString = true;
        }

        return $emptyString;
    }

    public function validateDate($date){
        $validDate = true;

        if($this->isEmpty($date)){
            $validDate = false;
        }else if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)){
            $validDate = false;
        }

        return $validDate;
    }

    public function validateTime($time){
        $validTime = true;

        $sanitizedTime = filter_var($time, FILTER_SANITIZE_NUMBER_INT);

        if($this->isEmpty($time)){
            $validTime = false;
        } else if(!filter_var($sanitizedTime, FILTER_VALIDATE_INT)){
            $validTime = false;
        } else if(strlen($sanitizedTime) != $this->TIME_LENGTH){
            $validTime = false;
        }

        return $validTime;
    }
}