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

    public function __construct($id, $name, $description, $price, $sale, $stock, $createdBy) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->sale = $sale;
        $this->stock = $stock;
        $this->imageUrl = $imageUrl;
        $this->createdBy = $createdBy;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getDescription() {
        return $this->description;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function getPrice() {
        return $this->price;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
    public function getSale() {
        return $this->sale;
    }
    public function setSale($sale) {
        $this->sale = $sale;
    }
    public function getStock() {
        return $this->stock;
    }
    public function setStock($stock) {
        $this->stock = $stock;
    }
    public function getImageUrl() {
        return $this->imageUrl;
    }
    public function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }
    public function getCreatedBy() {
        return $this->createdBy;
    }
    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }
}
?>