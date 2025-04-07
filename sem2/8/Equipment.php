<?php

class Equipment
{
    private int $num;
    private string $name;

    public function __construct(int $num, string $name)
    {
        $this->num = $num;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    public function sameItem(Equipment $equipment): bool
    {
        return $this->num == $equipment->num;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}