<?php
class User {
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $role;

    public function __construct($id, $first_name, $last_name, $email, $role = 'customer') {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->role = $role;
    }
    public static function getUserById($connection, $id) 
    {
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        if ($data) {
            return new User($data['id'], $data['first_name'], $data['last_name'], $data['email'], $data['role']);
        }
        return null;
    }
    public static function updateUserRole($connection, $id, $role) 
    {
        $sql = "UPDATE users SET role=? WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$role, $id]);
    }
    public static function deleteUser($connection, $id) 
    {
        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$id]);
    }
    public static function getAllUsers($connection) 
    {
        $sql = "SELECT * FROM users";
        $stmt = $connection->query($sql);
        $users = [];
        while ($data = $stmt->fetch()) {
            $users[] = new User($data['id'], $data['first_name'], $data['last_name'], $data['email'], $data['role']);
        }
        return $users;
    }
    public function getId()
    { 
        return $this->id; 
    }
    public function getFirstName()
    { 
        return $this->first_name; 
    }
    public function getLastName()
    { 
        return $this->last_name; 
    }
    public function getEmail()
    { 
        return $this->email; 
    }
}
?>