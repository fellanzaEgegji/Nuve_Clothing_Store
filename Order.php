<?php
require_once 'OrderItem.php';

class Order {
    private $id;
    private $date;
    private $status;
    private $items = [];

    public function __construct($id, $date, $status) {
        $this->id = $id;
        $this->date = $date;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getStatusClass() {
        return match ($this->status) {
            'Përfunduar' => 'completed',
            'Në Proces'  => 'inprocess',
            'Anuluar'    => 'cancelled',
            default      => ''
        };
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