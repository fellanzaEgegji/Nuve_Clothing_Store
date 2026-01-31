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
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Product(
            $row['id'],
            $row['name'],
            $row['description'],
            $row['price'],
            $row['sale'],
            $row['stock'],
            $row['image_url'],
            $row['created_by'],
            $row['category']
        );

    }

    public function createProduct($name, $description, $price, $sale, $stock, $imageUrl, $createdBy, $category) {
        $sql = "INSERT INTO products (name, description, price, sale, stock, image_url, created_by)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $description, $price, $sale, $stock, $imageUrl, $createdBy, $category]);
        return $this->conn->lastInsertId();
    }

    public function updateProduct($id, $name, $description, $price, $sale, $stock, $imageUrl, $createdBy, $category) {
        $sql = "UPDATE products SET name=?, description=?, price=?, sale=?, stock=?, image_url=?, created_by=?, category=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $description, $price, $sale, $stock, $imageUrl, $createdBy, $category, $id]);
    }

    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute([$id]);
    }
    public function getProductsByCategory($category) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE category = ?");
        $stmt->execute([$category]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products = [];
        foreach ($rows as $row) {
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['sale'],
                $row['stock'],
                $row['image_url'],
                $row['created_by'],
                $row['category']
            );
        }
        return $products;
    }

}
?>