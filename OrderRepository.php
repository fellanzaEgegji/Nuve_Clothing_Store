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
    public function updateOrder($id, $user_Id, $date, $status, $total) 
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
    public function cancelOrder($orderId) 
    {
        $sql = "UPDATE orders SET status = 'Anuluar' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $orderId);
        return $stmt->execute();
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
    public function getOrderItems($orderId)
    {
        $sql = "SELECT products.name, order_items.quantity, order_items.price_at_purchase
                FROM order_items
                JOIN products ON order_items.product_id = products.id
                WHERE order_items.order_id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrdersByUserId($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($ordersData as $data) {
            $order = new Order($data['id'], $data['user_id'], $data['date'], $data['status'], $data['total']);
            
            $stmtItems = $this->conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
            $stmtItems->execute([$data['id']]);
            $itemsData = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

            foreach ($itemsData as $itemData) {
                $productStmt = $this->conn->prepare("SELECT * FROM products WHERE id=?");
                $productStmt->execute([$itemData['product_id']]);
                $productData = $productStmt->fetch(PDO::FETCH_ASSOC);

                $product = new Product(
                    $productData['id'],
                    $productData['name'],
                    $productData['description'],
                    $productData['price'],
                    $productData['sale'],
                    $productData['stock'],
                    $productData['created_by'],
                    $productData['created_at'],
                    $productData['updated_at'],
                    $productData['image_url'] 
                );

                $orderItem = new OrderItem($product, $itemData['quantity'], $itemData['price_at_purchase']);
                $order->addItem($orderItem);
            }

            $orders[] = $order;
        }

        return $orders;
    }
}
