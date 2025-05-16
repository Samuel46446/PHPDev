<?php

class TrancheAge
{
    private int $code;
    private int $ageMin;
    private int $ageMax;

    public function __construct(int $code, int $ageMin, int $ageMax)
    {
        $this->code = $code;
        $this->ageMin = $ageMin;
        $this->ageMax = $ageMax;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getAgeMin(): int
    {
        return $this->ageMin;
    }

    public function getAgeMax(): int
    {
        return $this->ageMax;
    }
}