<?php

class Distributeur
{
    private int $id;
    private string $nom;
    private array $commandes;

    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->commandes = [];
    }

    public function addCommande(Commande $commande): void
    {
        $this->commandes[] = $commande;
    }

    public function getCommandes(): array
    {
        return $this->commandes;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getCommandeEnCours(string $nom)
    {
    }
}