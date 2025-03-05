<?php

class Employee
{
    private int $num;
    private string $name;
    private Grade $grade;
    private string $dateEmb;

    public function __construct(int $num, string $name, Grade $grade, string $dateEmb)
    {
        $this->num = $num;
        $this->name = $name;
        $this->grade = $grade;
        $this->dateEmb = $dateEmb;
    }

    public function getNum(): int
    {
        return $this->num;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGrade(): Grade
    {
        return $this->grade;
    }

    public function getDateEmb(): string
    {
        return $this->dateEmb;
    }

    public function setGrade(Grade $grade)
    {
        $this->grade = $grade;
    }

    public function hourlyCost(): float
    {
        $amount = $this->grade->hourlyRate();
        for($i = 0; $i < $this->dateEmb; $i++)
        {
            $amount += $amount * 0.02;
        }
        return $amount;
    }
}

?>