<?php
class ContactMessage {
    private $id;
    private $userId;
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $message;
    private $createdAt;
    public function __construct($userId, $firstName, $lastName, $email, $phone, $message) {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
    }
    public function getId() { 
        return $this->id; 
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getUserId() { 
        return $this->userId; 
    }
    public function setUserId($userId) {
        $this->userId = $userId;
    }
    public function getFirstName() { 
        return $this->firstName; 
    }
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    public function getLastName() { 
        return $this->lastName; 
    }
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    public function getEmail() { 
        return $this->email; 
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getPhone() { 
        return $this->phone; 
    }
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    public function getMessage() { 
        return $this->message; 
    }
    public function setMessage($message) {
        $this->message = $message;
    }
    public function getCreatedAt() { 
        return $this->createdAt; 
    }
    public function setCreatedAt($datetime) { 
        $this->createdAt = $datetime; 
    }
}
?>