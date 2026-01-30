<?php
require_once 'database.php';
require_once 'ContactMessage.php';

class ContactMessageRepository {
    private $conn;
    private $table = 'contact_messages';

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function save(ContactMessage $msg) {

        $sql = "INSERT INTO {$this->table} 
                (user_id, first_name, last_name, email, phone, message, created_at)
                VALUES (:user_id, :first_name, :last_name, :email, :phone, :message, :created_at)";

        $stmt = $this->conn->prepare($sql);

        $now = date('Y-m-d H:i:s');
        $msg->setCreatedAt($now);

        return $stmt->execute([
            ':user_id'    => $msg->getUserId(),
            ':first_name' => $msg->getFirstName(),
            ':last_name'  => $msg->getLastName(),
            ':email'      => $msg->getEmail(),
            ':phone'      => $msg->getPhone(),
            ':message'    => $msg->getMessage(),
            ':created_at' => $msg->getCreatedAt()
        ]);
    }
    public function getAllMessages() 
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessageById($id) 
    {
        $sql = "SELECT * FROM {$this->table} WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteMessage($id) 
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>