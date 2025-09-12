<?php

namespace sem2\casrafe;

use sem2\casrafe\Compteur;

include_once "Compteur.php";

class Branchement
{
    private Compteur $leCompteur;

    public function __construct(Compteur $compteur)
    {
        $this->leCompteur = $compteur;
    }

    public function conso(): int
    {
        return $this->leCompteur->releve();
    }
}