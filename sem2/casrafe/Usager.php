<?php

include_once "Branchement.php";

class Usager extends Branchement
{
    public function __construct(Compteur $compteur)
    {
        parent::__construct($compteur);
    }
}