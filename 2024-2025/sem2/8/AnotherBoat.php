<?php

namespace sem2\8;

use AbstractBoat;
use sem2\require_once 'AbstractBoat.php';
class AnotherBoat extends AbstractBoat
{
    private string $weight;

    public function __construct(int $id, string $name, float $width, float $length, string $weight)
    {
        parent::__construct($id, $name, $width, $length);
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getWeight(): string
    {
        return $this->weight;
    }
}