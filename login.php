<?php
    $page_css = "login.css";
    include_once 'header.php';
?>
    <!--Struktura e Login Form-->
    <div class="login-container">
        <h2>Kyçu në Llogarinë Tënde</h2>
        <form class="login-form" id="login-form" novalidate>
            <div class="form-group">
                <p>Emri dhe Mbiemri</p>
                <input type="text" id="emri-mbiemri" name="emri-mbiemri" placeholder="Shkruani emrin dhe mbiemrin" required>
                <div id="emriMbiemriError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Fjalëkalimi</p>
                <input type="password" id="password" name="password" placeholder="Shkruani fjalëkalimin" required>
                <div id="passwordError" class="error" aria-live="polite"></div>
            </div>
            <button type="submit" class="login-button">Kyçu</button>
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
    <script src="login.js"></script>
    <?php require_once 'footer.php' ?>