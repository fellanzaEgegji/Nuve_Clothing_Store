<?php
require_once 'Product.php';
class OrderItem {
    private $product;
    private $qty;
    private $sale;
    private $priceAtPurchase;

    public function __construct($product, $qty, $sale = 0) {
        $this->product = $product;
        $this->qty = $qty;
        $this->sale = $sale;
        $this->priceAtPurchase = $this->calculatePriceAtPurchase();
    }

    private function calculatePriceAtPurchase() {
        $price = $this->product->getPrice();

        if ($this->sale > 0) {
            $price -= ($price * $this->sale / 100);
        }

        return round($price, 2);
    }

    public function getProduct() {
        return $this->product;
    }

    public function getQty() {
        return $this->qty;
    }

    public function getSale() {
        return $this->sale;
    }

    public function getPrice() {
        return $this->priceAtPurchase;
    }

    public function getSubtotal() {
        return round($this->priceAtPurchase * $this->qty, 2);
    }
}
?>