<?php
require_once 'session.php';
require_once 'ShoppingCart.php';
require_once 'Order.php';
require_once 'OrderItem.php';
require_once 'OrderRepository.php';
require_once 'Database.php';

Session::start();

if (!Session::isLoggedIn()) {
    echo "<h2>Duhet të jeni të kyçur për të kryer porosinë.</h2>";
    exit;
}
$userId = is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user'];


$cart = new ShoppingCart();
$items = $cart->getItems();

if (empty($items)) {
    echo "<h2>Shporta juaj është bosh.</h2>";
    exit;
}

$order = new Order(
    null,
    $userId,
    date('Y-m-d H:i:s'),
    'Në Proces'
);


foreach ($items as $productId => $item) {

    if (!is_array($item)) continue;

    $product = new Product(
        $productId,
    $item['name'],
    $item['description'] ?? '',
    $item['price'],
    $item['sale'] ?? 0,
    $item['quantity'],          
    $item['image'] ?? '',        
    $item['brand'] ?? 'System'
    );

    $orderItem = new OrderItem($product, $item['quantity']);
    $order->addItem($orderItem);
}

$db = new Database();
$conn = $db->getConnection();
$repo = new OrderRepository($conn);

try {
    $orderId = $repo->save($order);
    $cart->clear(); 
} catch (PDOException $e) {
    echo "<h2>Gabim gjatë ruajtjes së porosisë:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout Succes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .success { background: #e0f7e9; padding: 20px; border: 2px solid #4CAF50; }
        ul { list-style: none; padding: 0; }
        li { padding: 5px 0; }
        a { display: inline-block; margin-top: 20px; text-decoration: none; color: #fff; background: #4CAF50; padding: 10px 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="success">
        <h1>✅ Porosia u ruajt me sukses!</h1>
        <p>Numri i porosisë: <strong><?= $orderId ?></strong></p>

        <h2>Produktet e porositura:</h2>
        <ul>
            <?php foreach ($order->getItems() as $item): ?>
                <li>
                    Produkt: <?= $item->getProduct()->getName() ?> |
                    Sasia: <?= $item->getQty() ?> |
                    Çmimi: <?= $item->getPrice() ?>€
                </li>
            <?php endforeach; ?>
        </ul>

        <p><strong>Total i porosisë: <?= $order->getTotal() ?>€</strong></p>

        <a href="index.php">Kthehu në faqen kryesore</a>
    </div>
</body>
</html>

