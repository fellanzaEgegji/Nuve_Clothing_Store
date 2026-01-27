<?php
require_once 'session.php';
require_once 'ShoppingCart.php';
require_once 'Order.php';
require_once 'OrderItem.php';
require_once 'OrderRepository.php';
require_once 'Database.php';

Session::start();
if (!isset($_SESSION['user_id'])) die("Duhet të jeni të kyçur.");

$userId = (int) $_SESSION['user_id'];


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

if (!isset($_SESSION['user_id'])) {
    die("User nuk është i kyçur");
}

$userId = (int) $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    die('User jo i kyçur');
}

$userId = $_SESSION['user_id'];



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


