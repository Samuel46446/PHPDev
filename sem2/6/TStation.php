<?php

class TStation
{
    private string $name;
    private int $nbReservoirs = 0;
    private array $reservoirs;
    private array $reservoirsOf;

    public function __construct(string $name, int $quantity, string... $reservoirTypes)
    {
        $this->reservoirsOf = [];
        $this->reservoirs = [
            new TReservoir("super", $quantity, $quantity), 
            new TReservoir("sp95", $quantity, $quantity), 
            new TReservoir("sp98", $quantity, $quantity), 
            new TReservoir("gazole", $quantity, $quantity)];
        $this->name = $name;
        for($i = 0; $i < count($reservoirTypes); $i++)
        {
            for($k = 0; $k < count($this->reservoirs); $k++)
            {
                if($reservoirTypes[$i] == $this->reservoirs[$k]->getCarburant())
                {
                    $this->reservoirsOf[$i] = $this->reservoirs[$k];
                    $this->nbReservoirs = $this->nbReservoirs + 1;
                }
            }
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBesoin(string $carburant): int
    {
        for($i = 0; $i < count($this->reservoirsOf); $i++)
        {
            if($this->reservoirsOf[$i]->getCarburant() == $carburant)
            {
                return $this->reservoirsOf[$i]->getVolumeRestant();
            }
        }
        return 0;
    }
}

?>