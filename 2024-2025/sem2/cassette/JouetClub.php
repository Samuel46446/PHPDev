<?php

use sem2\cassette\Catalogue;
use sem2\cassette\Categorie;
use sem2\cassette\Jouet;
use sem2\cassette\TrancheAge;

require_once 'TrancheAge.php';
require_once 'Categorie.php';
require_once 'Jouet.php';
require_once 'Catalogue.php';
require_once 'Map.php';

// Création des tranches d'âge
$tranche1 = new TrancheAge(1, 0, 3);
$tranche2 = new TrancheAge(2, 4, 7);

// Création des catégories
$categorie1 = new Categorie(1, "Peluches");
$categorie2 = new Categorie(2, "Véhicules");

// Création des jouets
$jouet1 = new Jouet(1, "Ours en peluche", $categorie1, $tranche1);
$jouet2 = new Jouet(2, "Voiture télécommandée", $categorie2, $tranche2);
$jouet3 = new Jouet(3, "Poupée", $categorie1, $tranche1);

// Création du catalogue
$catalogue = new Catalogue("2023");

// Ajout des jouets au catalogue
$catalogue->addJouet($jouet1, 10);
$catalogue->addJouet($jouet2, 5);
$catalogue->addJouet($jouet3, 7);

// Affichage des jouets du catalogue
echo "Catalogue de l'année " . $catalogue->getAnnee() . " :\n";
foreach ($catalogue->getLesJouets()->entries() as $entry) {
    $jouet = $entry['k'];
    $quantite = $entry['v'];
    echo "- Jouet : " . $jouet->getLibelle() . ", Quantité : $quantite\n";
}

// Quantité totale distribuée
echo "Quantité totale distribuée : " . $catalogue->QuantiteDistribuee() . "\n";

// Statistiques par catégorie
echo "Statistiques par catégorie :\n";
print_r($catalogue->StatCateg());
foreach ($catalogue->StatCateg()->entries() as $entry) {
    $categorieCode = $entry['k'];
    $quantite = $entry['v'];
    $categorie = $categorie1;
    foreach(Categorie::getLesCategories() as $cat) {
        if ($cat->getCode() == $categorieCode) {
            $categorie = $cat;
            break;
        }
    }
    echo "- Catégorie : " . $categorie->getLibelle() . ", Quantité : $quantite\n";
}