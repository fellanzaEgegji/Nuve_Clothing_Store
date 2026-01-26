<?php
class OrderRepository {
    private $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
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
