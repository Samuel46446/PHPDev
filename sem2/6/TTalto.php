<?php

class TTalto
{
    private int $nbCarburant;

    private array $mesReservoirs;
    private array $mesStations;

    public function __construct()
    {
        $this->nbCarburant = 0;
        $this->mesStations = [];
        $this->mesReservoirs = [];
        echo "TTalto init !\n";
    }

    public function getNbCarburant(): int
    {
        return $this->nbCarburant;
    }

    public function addReservoir(TReservoir& $reserv) : void
    {
        if(!$reserv->getEstUtilise())
        {
            $this->mesReservoirs[] = $reserv;
            $this->nbCarburant += 1;
            $reserv->setEstUtilise(true);
        }
    }

    public function getMesReservoirs(): array
    {
        return $this->mesReservoirs;
    }

    public function getMesStations(): array
    {
        return $this->mesStations;
    }

    public function addStation(TStation $station): void
    {
        $this->mesStations[] = $station;
    }

    public function getNbStations(): int
    {
        return count($this->mesStations);
    }

    public function getNbReservoirs(): int
    {
        return count($this->mesReservoirs);
    }

    public function getStation(int $i): TStation | null
    {
        if($i < $this->getNbStations() && $i >= 0)
        {
            if($this->mesStations[$i] != null)
            {
                return $this->mesStations[$i];
            }
        }
        return null;
    }

    public function livrer(string $carburant, int $volume): void
    {
        for($i = 0; $i < count($this->mesReservoirs); $i++)
        {
            if($this->mesReservoirs[$i]->getCarburant() == $carburant)
            {
                $this->mesReservoirs[$i]->changeVolume(-$volume);
                break;
            }
        }
    }

    public function reste(string $carburant): int
    {
        for($i = 0; $i < count($this->mesReservoirs); $i++)
        {
            if($this->mesReservoirs[$i]->getCarburant() == $carburant)
            {
                return $this->mesReservoirs[$i]->getVolumeRestant();
            }
        }
        echo "Carburant non trouvé\n";
        return 0;
    }
}

?>