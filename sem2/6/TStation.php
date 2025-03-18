<?php

class TStation
{
    private string $name;
    private int $nbReservoirs = 0;
    private array $reservoirs;

    public function __construct(string $name)
    {
        $this->reservoirs = [];
        $this->name = $name;
    }

    public function addReservoir(TReservoir& $reserv) : void
    {
        if(!$reserv->getEstUtilise())
        {
            $this->reservoirs[] = $reserv;
            $this->nbReservoirs += 1;
            $reserv->setEstUtilise(true);
        }
    }

    public function displayReservoirs(): void
    {
        for($i = 0; $i < count($this->reservoirs); $i++)
        {
            echo $this->reservoirs[$i]->getCarburant() . " : " . $this->reservoirs[$i]->getVolumeRestant() . " litres\n";
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBesoin(string $carburant): int
    {
        for($i = 0; $i < count($this->reservoirs); $i++)
        {
            if($this->reservoirs[$i]->getCarburant() == $carburant)
            {
                return $this->reservoirs[$i]->getVolumeBesoin();
            }
        }
        return 0;
    }
}

?>