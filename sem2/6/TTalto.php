<?php

class TTalto
{
    private int $nbCarburant;

    private array $mesReservoirs;
    private array $mesStations;

    public function __construct(int $nbCarburant = 10000)
    {
        $this->nbCarburant = $nbCarburant;
        $this->mesStations = [];
        $this->mesReservoirs = [        
            new TReservoir("super", $nbCarburant, $nbCarburant), 
            new TReservoir("sp95", $nbCarburant, $nbCarburant), 
            new TReservoir("sp98", $nbCarburant, $nbCarburant), 
            new TReservoir("gazole", $nbCarburant, $nbCarburant)];
        echo "TTalto init !\n";
    }

    public function addStation(TStation $station)
    {
        $this->mesStations[] = $station;
    }

    public function getNbStations()
    {
        return count($this->mesStations);
    }

    public function getStation(int $i): TStation
    {
        if($this->mesStations[$i] != null)
        {
            return $this->mesStations[$i];
        }
        else
        {
            echo "Station non trouvée, Une station par défaut est chargé\n";
            return new TStation("null", 0, 0);
        }
    }

    public function livrer(string $carburant, int $volume)
    {
        for($i = 0; $i < count($this->mesReservoirs); $i++)
        {
            if($this->mesReservoirs[$i]->getCarburant() == $carburant)
            {
                $this->mesReservoirs[$i]->changeVolume($volume*-1);
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