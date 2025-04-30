<?php

include_once "Branchement.php";

class Vanne extends Branchement
{
    public function __construct(Compteur $compteur)
    {
        parent::__construct($compteur);
    }
}