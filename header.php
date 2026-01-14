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
                <li><a href="">Meshkuj</a></li>
                <li><a href="">Femra</a></li>
                <li><a href="">Fëmijë</a></li>
            </ul>
            <div class="icons">
                <a href=""><img src="library/search.png" alt="search"></a>
                <a href="register.php"><img src="library/profile.png" alt="profile"></a>
                <a href=""><img src="library/cart.png" alt="cart"></a>
            </div>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </section>
