<?php
require_once 'session.php';
require_once 'Database.php';
require_once 'ProductRepository.php';

Session::start();

$db = new Database();
$conn = $db->getConnection();
$productRepo = new ProductRepository($conn);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = $productRepo->getProductById($id);

$page_css = 'products.css';
require_once 'header.php';
?>

<section class="product-details-container">
    <?php if (!$product): ?>
        <p>Produkt i panjohur.</p>
    <?php else: ?>
        <div class="product-details">
            <img src="<?= htmlspecialchars($product->getImageUrl()) ?>" alt="<?= htmlspecialchars($product->getName()) ?>">
            <div class="product-info">
                <h1><?= htmlspecialchars($product->getName()) ?></h1>
                <p><?= htmlspecialchars($product->getDescription()) ?></p>
                <p>Kategoria: <?= htmlspecialchars($product->getCategory()) ?></p>
                <p>Disponueshmëria: <?= $product->getStock() > 0 ? 'Në stok' : 'Jo në stok' ?></p>
                <div class="price">
                    <?php if ($product->getSale() > 0): ?>
                        <div class="sale-price">$<?= number_format($product->getSale(), 2) ?></div>
                        <div class="original-price">$<?= number_format($product->getPrice(), 2) ?></div>
                    <?php else: ?>
                        <div class="regular-price">$<?= number_format($product->getPrice(), 2) ?></div>
                    <?php endif; ?>
                </div>
                <form action="cart.php" method="POST" class="add-to-cart-form">
                    <input type="hidden" name="id" value="<?= $product->getId() ?>">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($product->getName()) ?>">
                    <input type="hidden" name="brand" value="<?= htmlspecialchars($product->getCreatedBy()) ?>">
                    <input type="hidden" name="price" value="<?= $product->getSale() > 0 ? $product->getSale() : $product->getPrice() ?>">
                    <input type="hidden" name="old_price" value="<?= $product->getPrice() ?>">
                    <input type="hidden" name="image" value="<?= htmlspecialchars($product->getImageUrl()) ?>">
                    <input type="hidden" name="category" value="<?= htmlspecialchars($product->getCategory()) ?>">
                    <input type="hidden" name="quantity" value="1">
                <button type="submit" name="add_to_cart" class="add-to-cart">Shto në Shportë</button>
</form>

            </div>
        </div>
    <?php endif; ?>
</section>

<?php require_once 'footer.php'; ?>
