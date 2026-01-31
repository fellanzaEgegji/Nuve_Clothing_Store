<?php
    require_once 'session.php';
    require_once 'Database.php';
    require_once 'ProductRepository.php';
    Session::start();
    $page_css = "products.css";
    $db = new Database();
    $conn = $db->getConnection();
    $productRepo = new ProductRepository($conn);
    $category = isset($_GET['category']) ? $_GET['category'] : null;

    if ($category) {
        $products = $productRepo->getProductsByCategory($category);
    } else {
        $products = $productRepo->getAllProducts();
    }
    ?>

    <?php require_once 'header.php'; ?>

    <section class="products-container">
        <div class="products-grid">
            <?php if (empty($products)): ?>
                <p>Nuk u gjet asnjë produkt.</p>
            <?php else: ?>
                <?php foreach ($products as $p): ?>
                    <a href="product-details.php?id=<?= $p->getId() ?>"> 
                        <div class="product-card">
                            <img src="<?= htmlspecialchars($p->getImageUrl()) ?>" alt="<?= htmlspecialchars($p->getName()) ?>">
                            <h2><?= htmlspecialchars($p->getName()) ?></h2>
                            <p><?= htmlspecialchars($p->getDescription()) ?></p>
                            <div class="price">
                                <?php if ($p->getSale() > 0): ?>
                                    <div class="sale-price">$<?= number_format($p->getSale(), 2) ?></div>
                                    <div class="original-price">$<?= number_format($p->getPrice(), 2) ?></div>
                                <?php else: ?>
                                    <div class="regular-price">$<?= number_format($p->getPrice(), 2) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <?php require_once 'footer.php'; ?>