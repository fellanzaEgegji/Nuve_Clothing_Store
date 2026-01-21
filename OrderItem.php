<?php
class OrderItem {
    private $name;
    private $qty;
    private $price;

    public function __construct(string $name, int $qty, string $price) {
        $this->name = $name;
        $this->qty = $qty;
        $this->price = $price;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name){
        $this -> name = $name;
    }

    public function getQty() {
        return $this->qty;
    }
    public function setQty($qty){
        $this -> qty = $qty;
    }

    public function getPrice() {
        return $this->price;
    }
    public function setPrice($price){
        $this -> price = $price;
    }
}
?>