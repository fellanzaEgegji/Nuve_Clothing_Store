<?php
    require_once 'session.php';
    require_once 'Auth.php';

    Session::start();
    $error = '';

    if (isset($_POST['login'])) {

    $email = $_POST['email'] ?? '';
    $password    = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $user = Auth::login($email, $password);

        if ($user) {
            $_SESSION['user'] = serialize($user);
            header("Location: index.php");
            exit;
        } else {
            $error = "Email ose fjalëkalimi është gabim!";
        }

    } else {
        $error = "Ju lutem plotësoni të gjitha fushat!";
    }
}

    $page_css = "login.css";
    include_once 'header.php';
?>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?> 

    <!--Struktura e Login Form-->
    <div class="login-container">
        <h2>Kyçu në Llogarinë Tënde</h2>

        <form class="login-form" id="login-form" method="POST" action="" novalidate>
            <div class="form-group">
                <p>Email</p>
                <input type="text" id="email" name="email" placeholder="Shkruani email-in" required>
                <div id="emailError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Fjalëkalimi</p>
                <input type="password" id="password" name="password" placeholder="Shkruani fjalëkalimin" required>
                <div id="passwordError" class="error" aria-live="polite"></div>
            </div>
            <button type="submit" name="login" class="login-button">Kyçu</button>
            <div id="formSuccess" class="success" role="status" aria-live="polite"></div>

            <p class="divider">ose</p>
            <div class="social-login">
                <button type="button" class="google-button">
                  <img src="library/google.png">Kyçu me Google
                </button>
                <button type="button" class="social apple-button">
                  <img src="library/apple.png">Kyçu me Apple
                </button>
            </div>
        </form>
        <p class="signup-text">
            Nuk ke llogari? <a href="register.php">Regjistrohu këtu.</a>
        </p>
    </div>
    <script src="login.js" ></script>
    <?php require_once 'footer.php' ?>