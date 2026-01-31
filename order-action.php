<?php
require_once 'session.php';
require_once 'Database.php';
require_once 'OrderRepository.php';
Session::start();

$db = new Database();
$conn = $db->getConnection();
$orderRepo = new OrderRepository($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $orderId = $_POST['id'] ?? null;

    if ($action === 'update_status' && $orderId) {
        $status = $_POST['status'] ?? null;
        if ($status) {
            $updated = $orderRepo->updateOrderStatus($orderId, $status);
            if ($updated) {
                header("Location: dashboard.php#orders");
                exit;
            } else {
                die("Gabim gjatë përditësimit të statusit.");
            }
        }
    }

    if ($action === 'delete' && $orderId) {
        $deleted = $orderRepo->deleteOrder($orderId);
        header("Location: dashboard.php#orders");
        exit;
    }
}
?>