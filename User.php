<?php
class User {
    private $userID;
    private $firstName;
    private $lastName;
    private $email;

    public function __construct($firstName, $lastName, $email) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function getUserID() {
        return $this->userID;
    }
    public function setUserID($userID){
        $this -> userID = $userID;
    }
    public function getFirstName() {
        return $this->firstName;
    }
    public function setFirstName($firstName){
        $this -> firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }
    public function setLastName($lastName){
        $this -> lastName = $lastName;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email){
        $this -> email = $email;
    }
}
?>