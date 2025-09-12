<?php

namespace sem2\cassette;

use sem2\cassette\Categorie;
use sem2\cassette\TrancheAge;

class Jouet
{
    private int $numero;
    private string $libelle;
    private Categorie $categorie;
    private TrancheAge $trancheAge;

    public function __construct(int $numero, string $libelle, Categorie $categorie, TrancheAge $trancheAge)
    {
        $this->numero = $numero;
        $this->libelle = $libelle;
        $this->categorie = $categorie;
        $this->trancheAge = $trancheAge;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function getCategorie(): Categorie
    {
        return $this->categorie;
    }
}