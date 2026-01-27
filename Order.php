<?php
require_once 'OrderItem.php';
class Order {
    private $id;
    private $user;
    private $date;
    private $status;
    private $items = [];

    public function __construct($id, $user, $date, $status) {
        $this->id = $id;
        $this->user = $user;
        $this->date = $date;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getDate() {
        return $this->date;
    }
    public function setDate($date) {
        $this->date = $date;
    }
    public function getStatus() {
        return $this->status;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
    public function getStatusClass() {
        return match ($this->status) {
            'Përfunduar' => 'completed',
            'Në Proces'  => 'inprocess',
            'Anuluar'    => 'cancelled',
            default      => ''
        };
    }
    public function getUserId() {
    return $this->user;
    }

    public function addItem($item) {
        $this->items[] = $item;
    }

    public function getItems() {
        return $this->items;
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getSubtotal();
        }
        return round($total, 2);
    }

    public function cancel() {
        if ($this->status === 'Në Proces') {
            $this->status = 'Anuluar';
            return true;
        }
        return false;
    }
}
?>