<?php

// Inclusion des classes
require_once 'TReservoir.php';
require_once 'TTalto.php';
require_once 'TStation.php';

// Exemple 1 : Création et utilisation d'un réservoir
echo "=== Exemple 1 : Création et utilisation d'un réservoir ===\n";

// Création d'un réservoir de super avec une capacité de 1000 litres et 500 litres restants
$reservoirSuper = new TReservoir(TReservoir::$C_SUPER, 1000, 500);

// Affichage du carburant et du volume restant
echo "Carburant: " . $reservoirSuper->getCarburant() . "\n";
echo "Volume restant: " . $reservoirSuper->getVolumeRestant() . " litres\n";

// Changement du volume restant
$reservoirSuper->changeVolume(200); // Ajoute 200 litres
echo "Nouveau volume restant: " . $reservoirSuper->getVolumeRestant() . " litres\n";

// Vérification du besoin de réapprovisionnement
$reservoirSuper->getVolumeBesoin();

echo "\n";

// Exemple 2 : Utilisation de la classe TTalto
echo "=== Exemple 2 : Utilisation de la classe TTalto ===\n";

// Création d'une instance de TTalto
$ttalto = new TTalto();

// Livraison de 500 litres de super
$ttalto->livrer(TReservoir::$C_SUPER, 500);

// Affichage du volume restant de super
echo "Volume restant de super: " . $ttalto->reste(TReservoir::$C_SUPER) . " litres\n";

// Affichage du volume restant de gazole
echo "Volume restant de gazole: " . $ttalto->reste(TReservoir::$C_GAZOLE) . " litres\n";

echo "\n";

// Exemple 3 : Création et utilisation d'une station
echo "=== Exemple 3 : Création et utilisation d'une station ===\n";

// Création d'une station avec des réservoirs de super et de gazole
$stationA = new TStation("Station A", 300, TReservoir::$C_SUPER, TReservoir::$C_GAZOLE);

// Affichage du nom de la station
echo "Nom de la station: " . $stationA->getName() . "\n";

// Affichage du besoin en super
echo "Besoin en super: " . $stationA->getBesoin(TReservoir::$C_SUPER) . " litres\n";

// Affichage du besoin en sp95 (non présent dans cette station)
echo "Besoin en sp95: " . $stationA->getBesoin(TReservoir::$C_SP95) . " litres\n";

echo "\n";

// Exemple 4 : Ajout d'une station à TTalto
echo "=== Exemple 4 : Ajout d'une station à TTalto ===\n";

// Ajout de la station A à TTalto
$ttalto->addStation($stationA);

// Affichage du nombre de stations dans TTalto
echo "Nombre de stations dans TTalto: " . $ttalto->getNbStations() . "\n";

// Récupération de la station ajoutée
$stationRecuperee = $ttalto->getStation(0);
echo "Nom de la station récupérée: " . $stationRecuperee->getName() . "\n";

echo "\n";

// Exemple 5 : Interaction entre TTalto et TStation
echo "=== Exemple 5 : Interaction entre TTalto et TStation ===\n";

// Création d'une deuxième station
$stationB = new TStation("Station B", 500, TReservoir::$C_SP95, TReservoir::$C_SP98);

// Ajout de la station B à TTalto
$ttalto->addStation($stationB);

// Affichage du nombre de stations dans TTalto
echo "Nombre de stations dans TTalto: " . $ttalto->getNbStations() . "\n";

// Livraison de 1000 litres de super à TTalto
$ttalto->livrer(TReservoir::$C_SUPER, 1000);

// Affichage du volume restant de super dans TTalto
echo "Volume restant de super dans TTalto: " . $ttalto->reste(TReservoir::$C_SUPER) . " litres\n";

// Affichage du besoin en super dans la station A
echo "Besoin en super dans la station A: " . $stationA->getBesoin(TReservoir::$C_SUPER) . " litres\n";

// Affichage du besoin en sp95 dans la station B
echo "Besoin en sp95 dans la station B: " . $stationB->getBesoin(TReservoir::$C_SP95) . " litres\n";

?>