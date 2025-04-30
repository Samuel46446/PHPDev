<?php

include_once "Compteur.php";
include_once "Branchement.php";
include_once "Secteur.php";
include_once "Usager.php";
include_once "Vanne.php";

class Commune
{
    private int $numCommune;
    private string $nomCommune;
    private array $lesSecteurs;

    public function __construct($numCommune, $nomCommune)
    {
        $this->numCommune = $numCommune;
        $this->nomCommune = $nomCommune;
        $this->lesSecteurs = [];
    }

    public function getNumCommune(): int
    {
        return $this->numCommune;
    }

    public function getNomCommune(): string
    {
        return $this->nomCommune;
    }

    public function ajouterUnSecteur(Secteur $secteur): void
    {
        $this->lesSecteurs[] = $secteur;
    }

    public function secteurEV(): array
    {
        $secteursEV = [];
        foreach ($this->lesSecteurs as $secteur) {
            if ($secteur->getEspaceVert()) {
                $secteursEV[] = $secteur;
            }
        }
        return $secteursEV;
    }

    public function volumeVannes(): int
    {
        return 0;
    }

    public function perte(): int
    {
        $usagers = [];
        $vannes = [];
        foreach ($this->lesSecteurs as $secteur) {
            foreach ($secteur->getLesBranchements() as $branchement) {
                if($branchement instanceof Usager)
                {
                    $usagers[] = $branchement;
                }
                else
                {
                    $vannes[] = $branchement;
                }
            }
        }

        $volTotalVannes = 0;
        $consommationUsagers = 0;
        foreach ($usagers as $usager) {
            $consommationUsagers += $usager->conso();
        }
        foreach ($vannes as $vanne) {
            $volTotalVannes += $vanne->conso();
        }

        return $volTotalVannes - $consommationUsagers;
    }

    public function anomalie(): int
    {
        $vannes = [];
        foreach ($this->lesSecteurs as $secteur) {
            foreach ($secteur->getLesBranchements() as $branchement) {
                if ($branchement instanceof Vanne) {
                    $vannes[] = $branchement;
                }
            }
        }

        $volTotalVannes = 0;
        foreach ($vannes as $vanne) {
            $volTotalVannes += $vanne->conso();
        }

        $perte = $this->perte();

        if ($volTotalVannes === 0) {
            return 0; // Évite une division par zéro
        }

        $pourcentagePertes = ($perte / $volTotalVannes) * 100;

        if ($pourcentagePertes < 10) {
            return 1;
        } elseif ($pourcentagePertes <= 15) {
            return 2;
        } else {
            return 3;
        }
    }
}