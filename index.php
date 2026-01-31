<?php
    require_once 'session.php';
    require_once 'Database.php';
    require_once 'ProductRepository.php';
    Session::start();
    $page_css = "index.css";
    $db = new Database();
    $conn = $db->getConnection();
    $productRepo = new ProductRepository($conn);
    $products = $productRepo->getProductsOnSale();
    require_once 'header.php';
?>

<!-- Struktura e heroit -->
        <section class="hero">
            <button id="previous"><img src="library/prev.png"></button>
            <img id="slideshow"/>
            <button id="next"><img src="library/next.png"></button>
        </section>
        <section class="products-slider-section">
        <h2>Produktet në Zbritje</h2>

        <div class="slider-wrapper">
            <button class="slider-btn prev">&#10094;</button>

            <div class="products-slider">
                <?php if (empty($products)): ?>
                    <p>Nuk u gjet asnjë produkt.</p>
                <?php else: ?>
                    <?php foreach ($products as $p): ?>
                        <div class="product-card">
                            <img src="<?= htmlspecialchars($p->getImageUrl()) ?>" alt="<?= htmlspecialchars($p->getName()) ?>">
                            <h2><?= htmlspecialchars($p->getName()) ?></h2>
                            <p><?= htmlspecialchars($p->getDescription()) ?></p>

                            <div class="price">
                                <div class="sale-price">
                                    $<?= number_format($p->getSale(), 2) ?>
                                </div>
                                <div class="original-price">
                                    $<?= number_format($p->getPrice(), 2) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <button class="slider-btn next">&#10095;</button>
        </div>
    </section>
        <!-- Struktura e brendeve -->
        <section class="brands">
            <div class="brands-container">
                <div class="brands-track">
                    <img src="library/burberry.png" alt="burberry">
                    <img src="library/calvinklein.png" alt="calvinklein">
                    <img src="library/chanel.png" alt="chanel">
                    <img src="library/dior.png" alt="dior">
                    <img src="library/h&m.png" alt="h&m">
                    <img src="library/lululemon.webp" alt="lululemon">
                    <img src="library/LV.png" alt="LV">
                    <img src="library/thenorthface.png" alt="thenorthface">
                    <img src="library/zara.png" alt="zara">
                    <img src="library/nike.jpg" alt="nike">
                    <img src="library/burberry.png" alt="burberry">
                    <img src="library/calvinklein.png" alt="calvinklein">
                    <img src="library/chanel.png" alt="chanel">
                    <img src="library/dior.png" alt="dior">
                    <img src="library/h&m.png" alt="h&m">
                    <img src="library/lululemon.webp" alt="lululemon">
                    <img src="library/LV.png" alt="LV">
                    <img src="library/thenorthface.png" alt="thenorthface">
                    <img src="library/zara.png" alt="zara">
                    <img src="library/nike.jpg" alt="nike">
                </div>
            </div>
        </section>

        <!-- Struktura e video-s -->
        <section class="video">
            <video id="video" loop autoplay muted playsinline><source src="library/video.webm"></video>
        </section>

<?php require_once 'footer.php' ?>