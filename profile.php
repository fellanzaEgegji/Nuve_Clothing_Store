<?php
    require_once 'session.php';
    if (!isset($_SESSION['role'])) {
        header("Location: login.php");
        exit;
    }
    $page_css = "profile.css";
    require_once 'header.php';
    if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
    }
?>
<!-- Struktura e user card -->
        <section class="profile">
            <div class="user-card">
                <div class="user-profile">
                    <img src="library/profileimage.png" alt="Profile image">
                </div>
                <div class="user-info">
                    <h1>Profili im</h1>
                <div class="info-row">
                    <span>Emri</span>
                    <p>Erblina</p>
                </div>
                <div class="info-row">
                    <span>Mbiemri</span>
                    <p>Ramadani</p>
                </div>
                <div class="info-row">
                    <span>Email</span>
                    <p>test@email.com</p>
                </div>
                <div class="profile-actions">
                    <button type="button" id="togglePassword">Ndrysho fjalëkalimin</button>
                    <form method="POST" style="display:inline;">
                        <button type="submit" name="logout" class="logout">Logout</button>
                    </form>
                </div>
                <form class="password-form" id="passwordForm" method="POST" action="" novalidate>
                    <div class="form-group">
                        <label>Fjalëkalimi aktual</label>
                        <input type="password" name="current_password" id="currentPassword" autocomplete="current-password" required>
                        <div id="currentError" class="error" aria-live="polite"></div>
                    </div>
                    <div class="form-group">
                        <label>Fjalëkalimi i ri</label>
                        <input type="password" name="new_password" id="newPassword" autocomplete="new-password" required>
                        <div id="newError" class="error" aria-live="polite"></div>
                    </div>
                    <div class="form-group">
                        <label>Konfirmo fjalëkalimin</label>
                        <input type="password" name="confirm_password" id="confirmPassword" autocomplete="new-password" required>
                        <div id="confirmError" class="error" aria-live="polite"></div>
                    </div>
                    <button type="submit" class="password-button" name="change_password">Ruaj ndryshimet</button>
                    <div id="formSuccess" class="success" role="status" aria-live="polite"></div>
                </form>
            </div>
        </div>
    </section>

<?php require_once 'footer.php' ?>