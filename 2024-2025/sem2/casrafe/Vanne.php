<?php

namespace sem2\casrafe;

use sem2\casrafe\Branchement;
use sem2\casrafe\Compteur;

include_once "Branchement.php";

class Vanne extends Branchement
{
    public function __construct(Compteur $compteur)
    {
        parent::__construct($compteur);
    }
}