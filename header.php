<?php
require_once 'session.php';
Session::start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuvé Clothing</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if (isset($page_css)): ?>
            <link rel="stylesheet" href="<?= $page_css ?>">
        <?php endif; ?>
    </head>
    <body>
        <!-- Struktura e Header-it -->
        <section class="header">
            <a href="index.php" class="logo"><img src="library/logo.png"></a>
            <ul>
                <li><a href="products.php?category=Meshkuj">Meshkuj</a></li>
                <li><a href="products.php?category=Femra">Femra</a></li>
                <li><a href="products.php?category=Fëmijë">Fëmijë</a></li>
                <li><a href="products.php">Të gjitha</a></li>
            </ul>
            <div class="icons">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="dashboard.php"><img src="library/dashboard.png" alt=""></a>
                <?php endif; ?>
                <a href=""><img src="library/search.png" alt="search"></a>
                <?php if (Session::isLoggedIn()): ?>
                    <a href="profile.php">
                        <img src="library/profile.png" alt="Profile">
                    </a>
                <?php else: ?>
                    <a href="login.php">
                        <img src="library/profile.png" alt="Login">
                    </a>
                <?php endif; ?>
                <a href="cart.php"><img src="library/cart.png" alt="cart"></a>
            </div>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </section>
