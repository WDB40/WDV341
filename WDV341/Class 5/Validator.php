<?php

class Validator
{

    private $MAX_SPECIAL_REQUEST = 200;
    private $PHONE_NUMBER_LENGTH = 10;

    public function __construct(){

    }

    public function validateName($name){
        $validName = true;

        if($this->isEmpty($name)) {
            $validName = false;
        }

        return $validName;
    }

    public function validatePhoneNumber($phoneNumber){
        $validPhoneNumber = true;

        $sanitizedPhoneNumber = filter_var($phoneNumber, FILTER_SANITIZE_SPECIAL_CHARS);

        if($this->isEmpty($sanitizedPhoneNumber)){
            $validPhoneNumber = false;
        } elseif(!filter_var($sanitizedPhoneNumber, FILTER_VALIDATE_INT)){
            $validPhoneNumber = false;
        } elseif(strlen($sanitizedPhoneNumber) != $this->PHONE_NUMBER_LENGTH){
            $validPhoneNumber = false;
        }

        return $validPhoneNumber;

    }

    public function validateEmail($email){
        $validEmail = true;

        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

        if($this->isEmpty($sanitizedEmail)){
            $validEmail = false;
        } elseif(!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)){
            $validEmail = false;
        }

        return $validEmail;
    }

    public function validateRegistration($registration){
        $validRegistration = true;

        if($this->isEmpty($registration)){
            $validRegistration = false;
        }

        return $validRegistration;
    }

    public function validateBadgeHolder($badgeHolder){
        $validBadgeHolder = true;

        if($this->isEmpty($badgeHolder)){
            $validBadgeHolder = false;
        }

        return $validBadgeHolder;
    }

    public function validateMeals($friday, $saturday, $sunday){
        $validMeals = true;

        if($this->isEmpty($friday) && $this->isEmpty($saturday) && $this->isEmpty($sunday)){
            $validMeals = false;
        }

        return $validMeals;
    }

    public function validateSpecialRequest($specialRequests){
        $validSpecialRequest = true;

        if(!$this->isEmpty($specialRequests) && !filter_var($specialRequests, FILTER_SANITIZE_SPECIAL_CHARS)){
            $validSpecialRequest = false;
        } elseif (strlen($specialRequests) > $this->MAX_SPECIAL_REQUEST){
            $validSpecialRequest = false;
        }

        return $validSpecialRequest;
    }

    private function isEmpty($input){
        $emptyString = false;

        $trimmedInput = trim($input);

        if(empty($trimmedInput)){
            $emptyString = true;
        }

        return $emptyString;
    }
}