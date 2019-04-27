<?php

    class Emailer {

        private $messageBody;
        private $senderAddress;
        private $sendToAddress;
        private $subjectLine;

        public function __construct(){

        }

        /*public function __construct($senderAddress, $sendToAddress, $subjectLine, $messageBody){

            $this->senderAddress = $senderAddress;
            $this->sendToAddress = $sendToAddress;
            $this->subjectLine = $subjectLine;
            $this->messageBody = $messageBody;
        }*/

        public function getMessageBody(){
            return $this->messageBody;
        }

        public function setMessageBody($messageBody){
            $this->messageBody = $messageBody;
        }

        public function getSenderAddress(){
            return $this->senderAddress;
        }

        public function setSenderAddress($senderAddress){
            $this->senderAddress = $senderAddress;
        }

        public function getSendToAddress(){
            return $this->sendToAddress;
        }

        public function setSendToAddress($sendToAddress){
            $this->sendToAddress = $sendToAddress;
        }

        public function getSubjectLine(){
            return $this->subjectLine;
        }

        public function setSubjectLine($subjectLine){
            $this->subjectLine = $subjectLine;
        }

        public function sendEmail(){
             return mail(
                 $this->getSendToAddress(),
                 $this->getSubjectLine(),
                 $this->getMessageBody(),
                 "From: " . $this->getSenderAddress() . "\r\n");
        }
    }