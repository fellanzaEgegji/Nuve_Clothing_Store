<?php
class User {
    private $userID;
    private $firstName;
    private $lastName;
    private $email;
    private $password;

    public function __construct($userID, $firstName, $lastName, $email, $password) {
        $this->userID = $userID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
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
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password){
        $this -> password = $password;
    }
}
?>