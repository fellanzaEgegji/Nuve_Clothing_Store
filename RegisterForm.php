<?php
require_once 'Auth.php';
require_once 'session.php';

class RegisterForm {
    public string $error = '';
    public string $emri = '';
    public string $mbiemri = '';
    public string $email = '';
    public string $password = '';
    public string $confirm = '';

    public function __construct() {
        Session::start();
    }

    public function handleSubmit(array $post): bool {
        $this->emri     = $post['emri'] ?? '';
        $this->mbiemri  = $post['mbiemri'] ?? '';
        $this->email    = $post['email'] ?? '';
        $this->password = $post['password'] ?? '';
        $this->confirm  = $post['confirm'] ?? '';

        if (empty($this->emri) || empty($this->mbiemri) || empty($this->email)
            || empty($this->password) || empty($this->confirm)) {
            $this->error = "Ju lutem plotësoni të gjitha fushat!";
            return false;
        }

        $result = Auth::register($this->emri, $this->mbiemri, $this->email, $this->password, $this->confirm);

        if ($result === true) {
            return true;
        } else {
            $this->error = $result;
            return false;
        }
    }
}
