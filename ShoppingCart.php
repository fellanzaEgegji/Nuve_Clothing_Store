<?php
class ShoppingCart {

    public function getItems() {
        return $_SESSION['cart'] ?? [];
    }

    public function updateQuantity($id, $quantity) {
        if ($quantity > 0 && isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = $quantity;
        }
    }

    public function removeItem($id) {
        unset($_SESSION['cart'][$id]);
    }

    public function getTotalQuantity() {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }

    public function getGrandTotal() {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function clear() {
        unset($_SESSION['cart']);
    }
}

