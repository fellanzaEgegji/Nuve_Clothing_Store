<?php
class Product {
    private $id;
    private $name;
    private $description;
    private $price;
    private $sale;
    private $stock;
    private $imageUrl;
    private $createdBy;
    private $category;

    public function __construct($id, $name, $description, $price, $sale, $stock, $imageUrl, $createdBy, $category) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->sale = $sale;
        $this->stock = $stock;
        $this->imageUrl = $imageUrl;
        $this->createdBy = $createdBy;
        $this->category = $category;
    }

    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getSale() {
        return $this->sale;
    }
    public function getStock() {
        return $this->stock;
    }
    public function getImageUrl() {
        return $this->imageUrl;
    }
    public function getCreatedBy() {
        return $this->createdBy;
    }
    public function getCategory() {
        return $this->category;
    }
}
?>