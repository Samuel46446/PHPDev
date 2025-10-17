<?php

require "Produit.php";

class Panier
{
    private string $ref;
    private array $lesProduits; //Collection de Produit

    function __construct(string $ref)
    {
        $this->ref = $ref;
        $this->lesProduits = array(); //panier initialement vide
    }

    public function getLesProduits(): array
    {
        return $this->lesProduits;
    }

    public function ajouterProduit(Produit $unProduit, int $quantite): void
    {
        $this->lesProduits[$unProduit->getRef()] = array('qte'=>$quantite, 'prix'=>$unProduit->getPrix());
    }

    public function totalSansPromotion(): int
    {
        $total = 0;
        foreach($this->lesProduits as $produit) {
            $total += $produit['qte'] * $produit['prix'];
        }
        return $total;
    }

    public function promotion(): void //pour un produit acheté, le second (de même référence) est moitié prix
    {
        $prixTot = 0;

        foreach($this->lesProduits as $ref => $produit) {
            if ($produit['qte'] > 1) {
                $nbProduitsPromo = intdiv($produit['qte'], 2);
                $this->lesProduits[$ref]['prix'] -= ($produit['prix'] / 2) * $nbProduitsPromo;
            }
        }
    }

    public function totalAvecPromotion(): int
    {
        $this->promotion();
        return $this->totalSansPromotion();
    }
}
