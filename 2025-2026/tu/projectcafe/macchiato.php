<?php
class Macchiato extends Cafe {
    private $sucre = 10; //quantite de sucre

    public function __construct() {
        parent::__construct(20);//quantite de cafe
    }

    public function getSucre() {
        return $this->sucre;
    }
}
?>