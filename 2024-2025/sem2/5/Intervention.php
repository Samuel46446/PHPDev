<?php

namespace sem2\5;

use sem2\use sem2\use sem2\class Intervention
{
    private
    int $num;
    private string $date;
    private int $duration;
    private float $rateKm;
    private Employee $engineer;

    public function __construct(int $num, string $date, int $duration, float $rateKm, Employee $engineer)
{
    $this->num = $num;
    $this->date = $date;
    $this->duration = $duration;
    $this->rateKm = $rateKm;
    $this->engineer = $engineer;
}

    public function chargesKm(float $dist): float
{
    return $dist * $this->rateKm;
}

    public function chargesMo(): float
{
    return $this->engineer->hourlyCost() * $this->duration;
}

    public function getNum(): int
{
    return $this->num;
}

    public function getDate(): string
{
    return $this->date;
}

    public function getDuration(): int
{
    return $this->duration;
}

    public function getRateKm(): float
{
    return $this->rateKm;
}

    public function getEngineer(): Employee
{
    return $this->engineer;
}
}

?>