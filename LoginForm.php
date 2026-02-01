<?php
require_once 'Auth.php';
require_once 'session.php';

class LoginForm {
    public string $error = '';
    public string $email = '';
    public string $password = '';

    public function __construct() {
        Session::start();
    }

    public function handleSubmit(array $post): bool {
        $this->email = $post['email'] ?? '';
        $this->password = $post['password'] ?? '';

        if (empty($this->email) || empty($this->password)) {
            $this->error = "Ju lutem plotësoni të gjitha fushat!";
            return false;
        }

        $user = Auth::login($this->email, $this->password);

        if ($user) {
            return true; // Login successful
        } else {
            $this->error = "Email ose fjalëkalim i gabuar!";
            return false;
        }
    }
}
