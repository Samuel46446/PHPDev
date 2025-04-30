<?php

class Secteur
{
    private int $numSecteur;
    private string $nomSecteur;
    private bool $espaceVert;
    private Commune $laCommune;
    private array $lesBranchements;

    public function __construct(int $numSecteur, string $nomSecteur, bool $espaceVert, Commune $laCommune)
    {
        $this->numSecteur = $numSecteur;
        $this->nomSecteur = $nomSecteur;
        $this->espaceVert = $espaceVert;
        $this->laCommune = $laCommune;
        $this->lesBranchements = [];
    }

    public function getLesBranchements(): array
    {
        return $this->lesBranchements;
    }

    public function ajouterUnBranchement(Branchement $branchement): void
    {
        $this->lesBranchements[] = $branchement;
    }

    public function getNumSecteur(): int
    {
        return $this->numSecteur;
    }

    public function getNomSecteur(): string
    {
        return $this->nomSecteur;
    }

    public function getEspaceVert(): bool
    {
        return $this->espaceVert;
    }
}