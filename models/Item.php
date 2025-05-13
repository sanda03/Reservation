<?php

class Item {
    private $name;
    private $isReserved;

    public function __construct($name) {
        $this->name = $name;
        $this->isReserved = false;
    }

    public function setReserved($reserved) {
        $this->isReserved = $reserved;
    }

    public function getName() {
        return $this->name;
    }

    public function isItemReserved() {
        return $this->isReserved;
    }
}
?>
