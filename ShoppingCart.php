<?php
class ShoppingCart {
    private array $items = [];
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->items = $_SESSION['cart'] ?? [];
    }
    private function save() {
        $_SESSION['cart'] = $this->items;
    }

    public function addItem(array $product) {
        $id = $product['id']; 
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] += $product['quantity'];
        } else {
            $this->items[$id] = $product;
        }
        $this->save();
    }

    public function getItems(): array {
        return $this->items;
    }

    public function updateQuantity($id, $quantity) {
        if ($quantity > 0 && isset($this->items[$id])) {
            $this->items[$id]['quantity'] = $quantity;
            $this->save();
        }
        
    }

    public function removeItem($id) {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
            $this->save();
        }
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
        $this->items = [];
        $this->save();
    }
}

