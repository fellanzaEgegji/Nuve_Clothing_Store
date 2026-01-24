<?php
require_once 'User.php';
require_once 'Database.php';
require_once 'session.php';

class Auth {
    public static function register($first_name, $last_name, $email, $password, $confirm) {

        // Kontrollohet nëse fjalëkalimet përputhen
        if ($password !== $confirm) {
            return "Fjalëkalimet nuk përputhen!";
        }

        // Lidhja me DB
        $db = new Database();
        $conn = $db->getConnection();

        // Kontrollohet nëse email ekziston
        $check = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $check->bindParam(':email', $email);
        $check->execute();

        if ($check->rowCount() > 0) {
            return "Email ekziston!";
        }

        // Futet përdoruesi në DB me bindParam
        $stmt = $conn->prepare(
            "INSERT INTO users (first_name, last_name, email, password)
             VALUES (:first_name, :last_name, :email, :password)"
        );

        // Hash fjalëkalimin
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Bind parametrat
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        // Ekzekutohet query
        if ($stmt->execute()) {
            return true;
        } else {
            return "Gabim gjatë regjistrimit!";
        }
    }
    public static function login($email, $password) {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT id, first_name, last_name, email, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
            Session::start();
            $_SESSION['userID'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            return $user;
        }
    }

    return false;
}
}



