<?php
require_once 'session.php';
require_once 'Database.php';
require_once 'ProductRepository.php';

Session::start();

class ProductController {
    private $productRepo;
    private $userId;

    public function __construct(ProductRepository $repo, $userId) {
        $this->productRepo = $repo;
        $this->userId = $userId;
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? null;

            switch ($action) {
                case 'create':
                    $this->createProduct($_POST, $_FILES);
                    break;
                case 'update':
                    $this->updateProduct($_POST, $_FILES);
                    break;
                case 'delete':
                    $this->deleteProduct($_POST['id'] ?? null);
                    break;
            }
        }
        // fallback
        header("Location: dashboard.php#products");
        exit;
    }

    private function createProduct($data, $files) {
        $imageUrl = $this->handleImageUpload($files['image'] ?? null);
        $this->productRepo->createProduct(
            $data['name'] ?? '',
            $data['description'] ?? '',
            $data['price'] ?? 0,
            $data['sale'] ?? 0,
            $data['stock'] ?? 0,
            $imageUrl,
            $this->userId,
            $data['category'] ?? 'Tjetër'
        );
    }

    private function updateProduct($data, $files) {
        $imageUrl = $data['existing_image'] ?? null;
        if (!empty($files['image']['name'])) {
            $imageUrl = $this->handleImageUpload($files['image']);
        }

        $this->productRepo->updateProduct(
            $data['id'],
            $data['name'] ?? '',
            $data['description'] ?? '',
            $data['price'] ?? 0,
            $data['sale'] ?? 0,
            $data['stock'] ?? 0,
            $imageUrl,
            $this->userId,
            $data['category'] ?? 'Tjetër'
        );
    }

    private function deleteProduct($id) {
        if ($id) {
            $this->productRepo->deleteProduct($id);
        }
    }

    private function handleImageUpload($file) {
        if ($file && !empty($file['name'])) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

            $fileName = time() . "_" . basename($file['name']);
            $targetFile = $targetDir . $fileName;

            move_uploaded_file($file['tmp_name'], $targetFile);
            return $targetFile;
        }
        return null;
    }
}

// DB connection
$db = new Database();
$conn = $db->getConnection();
$productRepo = new ProductRepository($conn);

$controller = new ProductController($productRepo, $_SESSION['user_id'] ?? 1);
$controller->handleRequest();

