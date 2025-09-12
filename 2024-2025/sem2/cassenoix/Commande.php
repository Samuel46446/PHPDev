<?php

namespace sem2\cassenoix;

use sem2\cassenoix\Produit;

class Commande
{
    private int $id;
    private float $prixHT;
    private string $conditionnement;
    private int $quantite;
    private string $dateConditionnement;
    private string $dateEnvoi;
    private array $produits;

    public function __construct(int $id, float $prixHT, string $conditionnement, int $quantite, string $dateConditionnement, string $dateEnvoi)
    {
        $this->id = $id;
        $this->prixHT = $prixHT;
        $this->conditionnement = $conditionnement;
        $this->quantite = $quantite;
        $this->dateConditionnement = $dateConditionnement;
        $this->dateEnvoi = $dateEnvoi;
        $this->produits = [];
    }

    public function addProduit(Produit $produit): void
    {
        $this->produits[] = $produit;
    }

    public function getProduits(): array
    {
        return $this->produits;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPrixHT(): float
    {
        return $this->prixHT;
    }

    public function getConditionnement(): string
    {
        return $this->conditionnement;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function getDateConditionnement(): string
    {
        return $this->dateConditionnement;
    }

    public function getDateEnvoi(): string
    {
        return $this->dateEnvoi;
    }

    public function EnCours()
    {

    }

    public function XMLCommande()
    {

    }
}