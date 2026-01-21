<?php
class Order {
    private $id;
    private $date;
    private $total;
    private $status;
    private $statusClass;
    private $items;

    public function __construct($id, $date, $total, $status, $statusClass, $items) {
        $this->id = $id;
        $this->date = $date;
        $this->total = $total;
        $this->status = $status;
        $this->statusClass = $statusClass;
        $this->items = $items;
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id){
        $this -> id = $id;
    }
    public function getDate() {
        return $this->date;
    }
    public function setDate($date){
        $this -> date = $date;
    }
    public function getTotal() {
        return $this->total;
    }
    public function setTotal($total){
        $this -> total = $total;
    }
    public function getStatus() {
        return $this->status;
    }
    public function setStatus($status){
        $this -> status = $status;
    }
    public function getStatusClass() {
        return $this->statusClass;
    }
    public function setStatusClass($statusClass){
        $this -> statusClass = $statusClass;
    }
    public function getItems() {
        return $this->items;
    }
    public function setItems($items){
        $this -> items = $items;
    }
}
?>