<?php

class TReservoir
{
    private string $carburant;
    private int $capacite;
    private int $volumeRestant;

    public static string $C_SUPER = "super";
    public static string $C_SP95 = "sp95";
    public static string $C_SP98 = "sp98";
    public static string $C_GAZOLE = "gazole";

    public function __construct(string $carburant, int $capacite, int $volumeRestant)
    {
        if($carburant == "super" || $carburant == "sp95" || 
        $carburant == "sp98" || $carburant == "gazole")
        {
            $this->carburant = $carburant;
        }
        else
        {
            echo("Carburant invalide\n");
            $this->carburant = self::$C_SUPER;
        }

        $this->capacite = $capacite;

        if($volumeRestant < 0 || $volumeRestant > $capacite)
        {
            echo("Volume invalide $volumeRestant trop grand ou trop petit\n");
            $this->volumeRestant = 0;
        }
        else
        {
            $this->volumeRestant = $volumeRestant;
        }
        $this->volumeRestant = $volumeRestant;
    }

    public function getCarburant(): string
    {
        return $this->carburant;
    }

    public function changeVolume(int $value)
    {
        if($this->volumeRestant + $value >= 0 && $this->volumeRestant + $value <= $this->capacite)
        {
            $this->volumeRestant += $value;
        }
        else
        {
            echo("Volume invalide, volumeRestant non changé\n");
        }
    }

    public function getVolumeBesoin()
    {
        $percent = $this->capacite * 0.2;
        
        if($this->volumeRestant < $percent)
        {
            $this->volumeRestant = $this->capacite;
            echo "Réapprovisionnement effectué\n";
        }
        else
        {
            echo "Pas besoin de réapprovisionnement\n";
        }
    }

    public function getVolumeRestant()
    {
        return $this->volumeRestant;
    }
}

?>