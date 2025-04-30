<?php

include_once "Commune.php";
include_once "Secteur.php";
include_once "Usager.php";
include_once "Vanne.php";
include_once "Compteur.php";

// Création des compteurs
$compteurUsager1 = new Compteur();
$compteurUsager2 = new Compteur();
$compteurVanne1 = new Compteur();
$compteurVanne2 = new Compteur();

// Mise à jour des index des compteurs
$compteurUsager1->setNewIndex(100);
$compteurUsager2->setNewIndex(200);
$compteurVanne1->setNewIndex(400);
$compteurVanne2->setNewIndex(300);

// Création des branchements
$usager1 = new Usager($compteurUsager1);
$usager2 = new Usager($compteurUsager2);
$vanne1 = new Vanne($compteurVanne1);
$vanne2 = new Vanne($compteurVanne2);

// Création d'une commune
$commune = new Commune(1, "MaCommune");

// Création des secteurs
$secteur1 = new Secteur(1, "Secteur 1", false, $commune);
$secteur2 = new Secteur(2, "Secteur 2", true, $commune);

// Ajout des branchements aux secteurs
$secteur1->ajouterUnBranchement($usager1);
$secteur1->ajouterUnBranchement($vanne1);
$secteur2->ajouterUnBranchement($usager2);
$secteur2->ajouterUnBranchement($vanne2);

// Ajout des secteurs à la commune
$commune->ajouterUnSecteur($secteur1);
$commune->ajouterUnSecteur($secteur2);

echo "Commune : " . $commune->getNomCommune() . " (ID : " . $commune->getNumCommune() . ")\n";

// Affichage des informations sur les secteurs
foreach ($commune->secteurEV() as $secteur) {
    echo "Secteur avec espace vert : " . $secteur->getNomSecteur() . " (ID : " . $secteur->getNumSecteur() . ")\n";
}

foreach ([$secteur1, $secteur2] as $secteur) {
    echo "Secteur : " . $secteur->getNomSecteur() . " (ID : " . $secteur->getNumSecteur() . ")\n";
    echo "Espace vert : " . ($secteur->getEspaceVert() ? "Oui" : "Non") . "\n";

    foreach ($secteur->getLesBranchements() as $branchement) {
        if ($branchement instanceof Usager) {
            echo " - Usager avec consommation : " . $branchement->conso() . " m³\n";
        } elseif ($branchement instanceof Vanne) {
            echo " - Vanne avec consommation : " . $branchement->conso() . " m³\n";
        }
    }
}

// Calcul des pertes et anomalies
echo "Pertes totales : " . $commune->perte() . " m³\n";

$anomalie = $commune->anomalie();
if ($anomalie === 1) {
    echo "Anomalie : Pertes inférieures à 10%\n";
} elseif ($anomalie === 2) {
    echo "Anomalie : Pertes entre 10% et 15%\n";
} elseif ($anomalie === 3) {
    echo "Anomalie : Pertes supérieures à 15%\n";
} else {
    echo "Anomalie : Aucune perte détectée\n";
}
