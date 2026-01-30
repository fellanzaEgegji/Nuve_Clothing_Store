<?php
    require_once 'session.php';
    require_once 'Database.php';
    require_once 'PageRepository.php';
    $page_css = "about&contact.css";
    require_once 'header.php';
    $db = new Database();
    $conn = $db->getConnection();
    $pageRepo = new PageRepository($conn);

    $page = $pageRepo->getPageByTitle("Rreth Nesh");
    ?>

<!-- Struktura main -->
    <section class="main">
        <div class="container">
            <img src="<?= htmlspecialchars($page['image']) ?>" alt="about-us-image">
            <div class="text">
                <h1><?= htmlspecialchars($page['title']) ?></h1>
                <p><?= htmlspecialchars($page['content']) ?></p>
            </div>
        </div>
    </section>

<?php require_once 'footer.php' ?>