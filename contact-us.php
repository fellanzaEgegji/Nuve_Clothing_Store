<?php
    require_once 'session.php';
    require_once 'Database.php';
    require_once 'Auth.php';
    require_once 'ContactMessage.php';
    require_once 'ContactMessageRepository.php';
    Session::start();
    $page_css = "about&contact.css";
    require_once 'header.php';
    $error = "";
    $success = "";

    $phone = '';
    $message = '';

    $emri = '';
    $mbiemri = '';
    $email = '';
    $userID = null;

    // Kontrollo nëse user është kyçur dhe session ka ID
    if (Session::isLoggedIn() && isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];    
        $user = unserialize($_SESSION['user']);
        $emri = $user->getFirstName();
        $mbiemri = $user->getLastName();
        $email = $user->getEmail();
    }

    if (isset($_POST['send'])) {
        if (!$userID) { // nuk ka ID valide
            $error = "Duhet të jeni të kyçur për të dërguar mesazhin.";
        } else {
            $phone = $_POST['phone'] ?? '';
            $message = $_POST['message'] ?? '';

            if (!empty($phone) && !empty($message) && $userID) {
                $contactMessage = new ContactMessage($userID, $emri, $mbiemri, $email, $phone, $message);

                $db = new Database();
                $repo = new ContactMessageRepository($db->getConnection());

                if ($repo->save($contactMessage)) {
                    $success = "Mesazhi u dërgua me sukses!";
                } else {
                    $error = "Gabim gjatë dërgimit të mesazhit!";
                }
            } else {
                $error = "Ju lutem plotësoni të gjitha fushat.";
            }
        }
    }
?>

<!-- Struktura main -->
    <section class="main">
        <div class="container">
            <img src="library/contact-us.jpg" alt="">
            <div class="text">
                <h1>Kontakti</h1>
                <p>Për çdo pyetje rreth porosive, madhësive, dërgesave apo bashkëpunimeve, ekipi ynë është gjithmonë i gatshëm t’ju ndihmojë. Na shkruani përmes formularit të kontaktit ose në rrjetet tona sociale dhe ne do të kthejmë përgjigje sa më shpejt që të jetë e mundur. Vlerësojmë çdo mesazh dhe jemi këtu për t’ju ofruar përvojën më të mirë të blerjes në butikun tonë online.</p>
            </div>
        </div>
    </section>

    <!-- Struktura e formes se kontaktit -->
    <div class="form-container">
        <h2>Na Kontaktoni</h2>
        <form class="contact-form" id="contact-form" method="POST" novalidate>
            <div class="form-group">
                <p>Emri</p>
                <input type="text" id="emri" name="emri" value="<?= htmlspecialchars($emri) ?>" required>
                <div id="emriError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Mbiemri</p>
                <input type="text" id="mbiemri" name="mbiemri" value="<?= htmlspecialchars($mbiemri) ?>" required>
                <div id="mbiemriError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Email</p>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                <div id="emailError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Numri i Telefonit</p>
                <input type="number" id="phone" name="phone" placeholder="Shkruani numrin e telefonit" required>
                <div id="phoneError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Mesazhi</p>
                <textarea id="message" name="message" placeholder="Shkruani mesazhin" required></textarea>
                <div id="messageError" class="error" aria-live="polite"></div>
            </div>
            <button type="submit" name="send" class="contact-button">Dergo</button>

            <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
            <div class="success"><?= $success ?></div>
            <?php endif; ?>
        </form>
    </div>

<?php require_once 'footer.php' ?>