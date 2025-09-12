<?php

namespace sem2\cassette;

use sem2\cassette\Jouet;
use sem2\cassette\Map;

class Catalogue
{
    private string $annee;
    private Map $lesJouets;

    public function __construct(string $annee)
    {
        $this->annee = $annee;
        $this->lesJouets = new Map();
    }

    public function getAnnee(): string
    {
        return $this->annee;
    }

    public function getLesJouets(): Map
    {
        return $this->lesJouets;
    }

    public function addJouet(Jouet $jouet, int $quantite): void
    {
        $this->lesJouets->put($jouet, $quantite);
    }

    public function QuantiteDistribuee(): int
    {
        $c = 0;
        foreach ($this->lesJouets->values() as $jouet) {
            $c += $jouet;
        }
        return $c;
    }

    public function StatCateg(): Map
    {
        $result = new Map();
        foreach ($this->lesJouets->entries() as $jouet) {
            if ($jouet['k'] instanceof Jouet) {
                $codeCat = $jouet['k']->getCategorie()->getCode();
                $qute = $jouet['v'];
                if (!$result->containsKey($codeCat)) {
                    $result->put($codeCat, 0);
                }
                $result->modify($codeCat, $result->get($codeCat) + $qute);
            }
        }
        return $result;
    }
}