<?php
    require_once 'session.php';
    require_once 'Auth.php';

    Session::start();

    if (isset($_POST['submit'])) {

    $emri      = $_POST['emri'] ?? '';
    $mbiemri   = $_POST['mbiemri'] ?? '';
    $email     = $_POST['email'] ?? '';
    $password  = $_POST['password'] ?? '';
    $confirm   = $_POST['confirm'] ?? '';

    if (!empty($emri) && !empty($mbiemri) && !empty($email) 
        && !empty($password) && !empty($confirm)) {

        $result = Auth::register($emri, $mbiemri, $email, $password, $confirm);

        if ($result === true) {
            header("Location: login.php");
            exit;
        } else {
            $error = $result;
        }

    } else {
        $error = "Ju lutem plotësoni të gjitha fushat!";
    }
}

 $page_css = "register.css";
include_once 'header.php';
?>

<?php if (isset($error)): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?> 

    <!--Struktura e Register Form-->
    <div class="register-container">
        <h2>Krijo Llogari</h2>
        <form class="register-form" id="register-form" method="POST" action="" novalidate>
            <div class="form-group">
                <p>Emri</p>
                <input type="text" id="emri" name="emri" placeholder="Shkruani emrin" required>
                <div id="emriError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Mbiemri</p>
                <input type="text" id="mbiemri" name="mbiemri" placeholder="Shkruani mbiemrin" required>
                <div id="mbiemriError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Email</p>
                <input type="email" id="email" name="email" placeholder="Shkruani email-in" required>
                <div id="emailError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Fjalëkalimi</p>
                <input type="password" id="password" name="password" placeholder="Shkruani fjalëkalimin" required>
                <div id="passwordError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Konfirmo fjalëkalimin</p>
                <input type="password" id="confirm" name="confirm" placeholder="Përsëritni fjalëkalimin" required>
                <div id="confirmError" class="error" aria-live="polite"></div>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="terms" required>
                <label for="terms">Pranoj Termat dhe Kushtet</label>
                <div id="termsError" class="error"></div>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="news">
                <label for="news">Pranoj të marr njoftime me Email & SMS</label>
            </div>
            <button type="submit" name="submit" class="register-button">Regjistrohu</button>
            <div id="formSuccess" class="success" role="status" aria-live="polite"></div>
        </form>
        <p class="signin-text">
            Ke llogari? <a href="login.php">Kyçu këtu.</a>
        </p>
    </div>
    <script src="register.js"></script>
<?php require_once 'footer.php' ?>
