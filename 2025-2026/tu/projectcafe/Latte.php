<?php

require_once "cafe.php";

class Latte extends Cafe
{
    private int $cafe = 20;
    private int $lait = 10;

    public function __construct()
    {
        parent::__construct($this->cafe);
    }

    public function getLait(): int
    {
        return $this->lait;
    }
}