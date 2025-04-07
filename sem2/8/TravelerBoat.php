<?php

require_once "AbstractBoat.php";
require_once "Equipment.php";
class TravelerBoat extends AbstractBoat
{
    private float $speed;
    private string $pictureLocation;
    private array $equipments;

    public function __construct(int $id, string $name, float $width, float $length, float $speed, string $pictureLocation)
    {
        parent::__construct($id, $name, $width, $length);
        $this->speed = $speed;
        $this->pictureLocation = $pictureLocation;
        $this->equipments = [];
    }

    public function __toString(): string
    {
        $result = "";

        foreach($this->getEquipments() as $equipment)
        {
            $result .= "- " . $equipment->__toString() . "\n";
        }

        return parent::__toString() . "Vitesse : " . $this->speed . " noeuds\n"
            . "Liste des équipements du bateau : "
            . $result . "\n";
    }

    public function addEquipments(Equipment $equipment) : void
    {
        $this->equipments[] = $equipment;
    }

    /**
     * @return array
     */
    public function getEquipments(): array
    {
        return $this->equipments;
    }

    /**
     * @return string
     */
    public function getPictureLocation(): string
    {
        return $this->pictureLocation;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }
}