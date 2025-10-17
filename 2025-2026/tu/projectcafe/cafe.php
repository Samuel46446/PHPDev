<?php
class Cafe {
    private $cafe;//quantité de café

    public function __construct($cafe) {
        $this->cafe = $cafe;
    }

    public function getCafe() {
        return $this->cafe;
    }
}

?>