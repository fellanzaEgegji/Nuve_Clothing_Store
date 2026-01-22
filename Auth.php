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
        if (
            $email === self::$fakeUser['email'] &&
            $password === self::$fakeUser['password']
        ) {
            $_SESSION['userID'] = self::$fakeUser['userID'];
            $_SESSION['email'] = self::$fakeUser['email'];

            return new User(
                self::$fakeUser['firstName'],
                self::$fakeUser['lastName'],
                self::$fakeUser['email']
            );
        }
        return false;
    }
}
