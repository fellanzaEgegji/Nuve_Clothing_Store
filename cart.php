<?php
require_once 'session.php';
require_once 'ShoppingCart.php';
require_once 'ProductRepository.php';
Session::start();
$cart = new ShoppingCart();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=[1 =>[
        'name' => 'Xhaketë me rrip',
        'brand' => 'Nuvé',
        'price' => 19,
        'old_price' => 65,
        'size' => 'S',
        'color' => 'Bordo',
        'image' => 'library/product.jpg',
        'quantity' =>1    
        ]
    ];
}

if (isset($_POST['update'])) {
    $cart->updateQuantity($_POST['id'], (int)$_POST['quantity']);
}

if (isset($_POST['remove'])) {
    $cart->removeItem($_POST['id']);
}

$page_css = "cart.css";
include_once 'header.php';

$totalQty   = $cart->getTotalQuantity();
$grandTotal = $cart->getGrandTotal();
$items      = $cart->getItems();
?>
<!--Struktura e shportës-->
<div class="cart-container">
    <?php
$totalQty = 0;
$grandTotal = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalQty   = $cart->getTotalQuantity();
        $grandTotal = $cart->getGrandTotal();
    }
}
?>

    <h1>Shporta juaj(<?= $totalQty?>)</h1>
    <p><strong>Total i shportës: </strong><?= $grandTotal ?>€</p>

     <?php if (!empty($cart->getItems())): ?>

        <?php foreach ($cart->getItems() as $id => $item): ?>
            <?php $productTotal = $item['price'] * $item['quantity']; ?>

        <div class="cart-card">
            <p class="delivery">📦 Dorëzohet nga <strong><?= $item['brand']?></strong></p>

            <div class="cart-item">
                <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                <div class="item-info">
                    <h2><?= $item['brand']?></h2>
                    <p class="product-name"><?= $item['name']?></p>

                    <div class="price">
                        <span class="new"><?= $item['price']?>€</span>
                        <span class="old"><?= $item['old_price']?>€</span>
                    </div>

                    <p><strong>Madhësia: </strong><?= $item['size']?></p>
                    <p><strong>Ngjyra: </strong><?= $item['color']?></p>

                    <form method="POST" class="quantity-form">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <label>Sasia: </label>
                        <div class="qty-box">
                            <button type="button" class="minus">-</button>
                            <input type="number" name="quantity" value="<?= $item['quantity']?>" min="1">
                            <button type="button" class="plus">+</button>
                        </div>
                        <button type="submit" name="update" class="update-btn">Përditëso</button>
                    </form>
                </div>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <button type="submit" name="remove" class="remove">🗑️</button>
                </form>
            </div>
            <div class="checkout-wrapper">
            <form action="checkout.php" method="POST">
                <button type="submit" class="checkout-btn">Përfundo Porosinë</button>
            </form>
        </div>
        </div>

    <?php endforeach; ?>
    
</form>
<?php else: ?>
        <!-- Mesazh kur shporta është bosh -->
        <p>Shporta juaj është bosh.</p>
    <?php endif; ?>

</div>
<script src="cart.js"></script>
<?php require_once 'footer.php' ?>