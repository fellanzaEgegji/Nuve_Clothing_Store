<?php
require_once 'Product.php';

class ProductRepository {
    private $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct($name, $description, $price, $sale, $stock, $imageUrl, $createdBy) {
        $sql = "INSERT INTO products (name, description, price, sale, stock, image_url, created_by)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $description, $price, $sale, $stock, $imageUrl, $createdBy]);
        return $this->conn->lastInsertId();
    }

    public function updateProduct($id, $name, $description, $price, $sale, $stock, $imageUrl, $createdBy) {
        $sql = "UPDATE products SET name=?, description=?, price=?, sale=?, stock=?, image_url=?, created_by=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $description, $price, $sale, $stock, $imageUrl, $createdBy, $id]);
    }

    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>