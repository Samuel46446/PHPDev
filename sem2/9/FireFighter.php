<?php

class FireFighter
{
    private string $name;
    private string $surname;
    private string $telephone;
    private bool $isAvailable;

    function __construct(string $name, string $surname, string $telephone)
    {
        $this->name=$name;
        $this->surname=$surname;
        $this->telephone=$telephone;
        $this->isAvailable=true;
    }

    public function commission(Period $period): void
    {
        $this->isAvailable=false;
        $period->commission($this);
    }

    public function statue(Period $period): string
    {
        return $period->statue($this);
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }
}