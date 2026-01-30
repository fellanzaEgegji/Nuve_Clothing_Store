<?php
require_once 'session.php';
require_once 'Database.php';
require_once 'ProductRepository.php';

// DB connection
$db = new Database();
$conn = $db->getConnection();
$productRepo = new ProductRepository($conn);

// Vetëm POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dashboard.php");
    exit;
}

$action = $_POST['action'] ?? null;

// CREATE
if ($action === 'create') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $sale = $_POST['sale'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $createdBy = $_SESSION['user_id'] ?? 1;

    // Upload image
    $imageUrl = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;

        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        $imageUrl = $targetFile;
    }

    $productRepo->createProduct($name, $description, $price, $sale, $stock, $imageUrl, $createdBy);
    header("Location: dashboard.php#products");
    exit;
}

// UPDATE
if ($action === 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];
    $stock = $_POST['stock'];
    $createdBy = $_SESSION['user_id'] ?? 1;
    $imageUrl = $_POST['existing_image'] ?? null;

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;

        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        $imageUrl = $targetFile;
    }

    $productRepo->updateProduct($id, $name, $description, $price, $sale, $stock, $imageUrl, $createdBy);
    header("Location: dashboard.php#products");
    exit;
}

// DELETE
if ($action === 'delete') {
    $id = $_POST['id'];
    $productRepo->deleteProduct($id);
    header("Location: dashboard.php#products");
    exit;
}

// fallback
header("Location: dashboard.php");
exit;
?>
