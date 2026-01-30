<?php
class OrderRepository {
    private $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }
    
    public function getAllOrders() 
    {
        $sql = "SELECT * FROM orders";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrderById($id) 
    {
        $sql = "SELECT * FROM orders WHERE id=?";
        $statement = $this->conn->prepare($sql);
        $statement->execute([$id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function createOrder($user_id, $date, $status, $total) {
        $sql = "INSERT INTO orders (user_id, date, status, total) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $date, $status, $total]);
        return $this->conn->lastInsertId();
    }
    public function updateOrder($id, $userId, $date, $status, $total) 
    {
        $sql = "UPDATE orders SET user_id=?, date=?, status=?, total=? WHERE id=?";
        $statement = $this->conn->prepare($sql);
        $statement->execute([$user_id, $date, $status, $total, $id]);
    }
     public function deleteOrder($id) 
     {
        $stmtItem = $this->conn->prepare("DELETE FROM order_items WHERE order_id=?");
        $stmtItem->execute([$id]);

        $stmt = $this->conn->prepare("DELETE FROM orders WHERE id=?");
        $stmt->execute([$id]);
    }


    public function save(Order $order) {

        $stmt = $this->conn->prepare(
            "INSERT INTO orders (user_id, date, status, total)
             VALUES (:user_id, :date, :status, :total)"
        );

        $stmt->execute([
            ':user_id' => $order->getUserId(),
            ':date'    => $order->getDate(),
            ':status'  => $order->getStatus(),
            ':total'   => $order->getTotal()
        ]);

        $orderId = $this->conn->lastInsertId();

        $stmtItem = $this->conn->prepare(
            "INSERT INTO order_items
             (order_id, product_id, quantity, price_at_purchase)
             VALUES (:order_id, :product_id, :quantity, :price)"
        );

        foreach ($order->getItems() as $item) {
            $stmtItem->execute([
                ':order_id'   => $orderId,
                ':product_id' => $item->getProduct()->getId(),
                ':quantity'   => $item->getQty(),
                ':price'      => $item->getPrice()
            ]);
        }

        return $orderId;
    }
}
