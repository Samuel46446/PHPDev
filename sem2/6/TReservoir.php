<?php

class TReservoir
{
    private string $carburant;
    private int $capacite;
    private int $volumeRestant;
    private bool $estUtilise;

    public static string $C_SUPER = "super";
    public static string $C_SP95 = "sp95";
    public static string $C_SP98 = "sp98";
    public static string $C_GAZOLE = "gazole";

    public function __construct(string $carburant, int $capacite, int $volumeRestant)
    {
        $this->estUtilise = false;
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
    }

    public function getEstUtilise() : bool
    {
        return $this->estUtilise;
    }

    public function setEstUtilise(bool $b) : void
    {
        $this->estUtilise = $b;
    }

    public function getCarburant(): string
    {
        return $this->carburant;
    }

    public function changeVolume(int $value) : void
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

    public function getVolumeBesoin() : int
    {
        $percent = $this->capacite * 0.2;
        
        if($this->volumeRestant < $percent)
        {
            return $this->capacite - $this->volumeRestant;
        }
        return 0;
    }

    public function getVolumeRestant() : int
    {
        return $this->volumeRestant;
    }
}

?>