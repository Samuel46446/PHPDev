<?php

require '.././vendor/autoload.php';
require 'Panier.php';
require 'Produit.php';

class PanierTest extends PHPUnit\Framework\TestCase
{
    private Panier $panier; //objet Panier du test

    public function setUp(): void
    {
        $this->panier=new Panier('monPanier');
        $this->panier->ajouterProduit(new Produit('bic','bic bleu',1),5);
        $this->panier->ajouterProduit(new Produit('rame80g','rame 500feuilles 80grammes',5),1);
    }

    public function testAjouterProduit()
    {
        self::assertArrayHasKey('bic', $this->panier->getLesProduits(), "Erreur dans l'ajout du produit bic");
        self::assertArrayHasKey('rame80g',$this->panier->getLesProduits(), "Erreur dans l'ajout du produit rame80g");
    }

    public function testTotalSansPromotion()
    {
        self::assertEquals(10,$this->panier->totalSansPromotion(), "Erreur dans le calcul du total sans promotion");
    }
    // A COMPLETER
    
}
