<?php
class PageRepository {
    private $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function getPageByTitle($title) {
        $stmt = $this->conn->prepare("SELECT * FROM pages WHERE title = ?");
        $stmt->execute([$title]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>