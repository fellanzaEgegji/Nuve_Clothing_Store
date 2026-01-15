<?php
    require_once 'session.php';
    $page_css = "about&contact.css";
    require_once 'header.php';
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
        <form class="contact-form" id="contact-form" novalidate>
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
                <p>Numri i Telefonit</p>
                <input type="number" id="phone" name="phone" placeholder="Shkruani numrin e telefonit" required>
                <div id="phoneError" class="error" aria-live="polite"></div>
            </div>
            <div class="form-group">
                <p>Mesazhi</p>
                <textarea id="message" name="message" placeholder="Shkruani mesazhin" required></textarea>
                <div id="messageError" class="error" aria-live="polite"></div>
            </div>
            <button type="submit" class="contact-button">Dergo</button>
        </form>
    </div>
    <div id="notification" class="notification">Mesazhi u dërgua me sukses!</div>

<?php require_once 'footer.php' ?>