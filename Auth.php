<?php
require_once 'User.php';

class Auth {

    // Simulim i user-it
    private static $fakeUser = [
        'email' => 'test@email.com',
        'password' => 'Test@123', 
        'userID' => 1,
        'firstName' => 'Erblina',
        'lastName' => 'Ramadani'
    ];

    public static function login($email, $password) {
        if (isset($_SESSION['registeredUser'])) {
        $u = $_SESSION['registeredUser'];

        if ($email === $u['email'] && $password === $u['password']) {

            $_SESSION['userID'] = 2;
            $_SESSION['email']  = $u['email'];

            return new User(
                2,                   
                $u['firstName'],
                $u['lastName'],
                $u['email'],
                $u['password']
            );
        }
    }
    return false;

    }
    public static function register($firstName, $lastName, $email, $password, $confirm) {

        if ($password !== $confirm) {
            return "Fjalëkalimet nuk përputhen!";
        }

        // Simulim
        $_SESSION['registeredUser'] = [
            'firstName' => $firstName,
            'lastName'  => $lastName,
            'email'     => $email,
            'password'  => $password 
        ];

        return true;
    }
}
