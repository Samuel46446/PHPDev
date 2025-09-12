<?php

namespace sem2\8;

abstract class AbstractBoat // Une classe qui ne peut être initialiser mais peut être hérité
{
    private int $id; // Identifiant du bateau
    private string $name; // Nom du bateau
    private float $width; // Largeur du bateau
    private float $length; // Longueur du bateau

    /* Constructeur */
    public function __construct(int $id, string $name, float $width, float $length)
    {
        $this->id = $id;
        $this->name = $name;
        $this->width = $width;
        $this->length = $length;
    }

    public function __toString(): string
    {
        return "Nom du bateau : " . $this->name . " \n"
            . "Longueur : " . $this->length . " mètres\n"
            . "Largeur : " . $this->width . " mètres\n";
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->length;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }
}
