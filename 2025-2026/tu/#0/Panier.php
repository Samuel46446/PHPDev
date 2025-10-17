<?php
class Panier
{
    private $montantTotal;

    function setMontantTotal($montant)
    {
        $this->montantTotal = $montant;
    }

    function remise()
    {
        return $this->montantTotal * 0.10; //10% de remise
    }

    function remise2()
    {
        $montantVar = $this->montantTotal;
        $remise = 0;
        if ($montantVar / 60 >= 0) {
            $remise = 3 * intval($montantVar / 60);
        }
        return $remise;
    }

    function remise3()
    {
        if($this->montantTotal >= 50 && $this->montantTotal <= 100) {
            return 2;
        } elseif($this->montantTotal > 100) {
            return 5;
        }
        else {
           return 0;
        }
    }
}