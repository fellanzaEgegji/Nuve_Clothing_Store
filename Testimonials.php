<?php
class Testimonials {
    private $conn;
    private $table_name = "testimonials";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table_name} ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($name, $text) {
        $query = "INSERT INTO {$this->table_name} (name, text) VALUES (:name, :text)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':text', $text);
        return $stmt->execute();
    }
}
?>
