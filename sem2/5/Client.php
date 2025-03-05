<?php

class Client
{
    private int $num;
    private string $name;
    private array $address;
    private string $postalCode;
    private string $city;
    private int $nbKm;

    public function __construct(int $num, string $name, array $address, string $postalCode, string $city, int $nbKm)
    {
        $this->num = $num;
        $this->name = $name;
        $this->address = $address;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->nbKm = $nbKm;
    }
    
    public function distance(): float
    {
        return $this->nbKm;
    }

    public function getNum(): int
    {
        return $this->num;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): array
    {
        return $this->address;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getNbKm(): int
    {
        return $this->nbKm;
    }
}

?>