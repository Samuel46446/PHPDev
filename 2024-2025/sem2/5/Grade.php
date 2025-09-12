<?php

namespace sem2\5;

class Grade
{
    private string $code;
    private string $name;
    private float $rate;

    public function __construct(string $code, string $name, float $rate)
    {
        $this->code = $code;
        $this->name = $name;
        $this->rate = $rate;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function hourlyRate()
    {
        return $this->rate;
    }
}

?>