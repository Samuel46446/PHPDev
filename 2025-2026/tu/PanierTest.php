<?php
require './vendor/autoload.php';
require 'Panier.php';

class PanierTest extends PHPUnit\Framework\TestCase
{
    public function testRemise()
    {
        $p1 = new Panier();
        $p1->setMontantTotal(100);
        $p2 = new Panier();
        $p2->setMontantTotal(121);
        $p3 = new Panier();
        $p3->setMontantTotal(49);

        $this->assertEquals(10, $p1->remise(), 'ERREUR REMISE 1');
        $this->assertEquals(6, $p2->remise2(), 'ERREUR REMISE 2');
        $this->assertEquals(0, $p3->remise3(), 'ERREUR REMISE 3');

    }
}
