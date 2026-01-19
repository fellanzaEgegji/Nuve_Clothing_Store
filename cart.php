<?php
require_once 'session.php';

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

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $qty = (int)$_POST['quantity'];

    if($qty > 0){
        $_SESSION['cart']['$id']['quantity'] = $qty;
    }
}
if(isset($_POST['remove'])){
    $id = $_POST['id'];
    unset($_SESSION['cart'][$id]);
}
$page_css = "cart.css";
include_once 'header.php';
?>
<!--Struktura e shportës-->
<div class="cart-container">
    <h1>Shporta juaj(<?=count($_SESSION['cart'])?>)</h1>

    <?php foreach($_SESSION['cart'] as $id => $item): ?>
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
        </div>
    <?php endforeach; ?>
</div>
<script src="cart.js"></script>
<?php require_once 'footer.php' ?>