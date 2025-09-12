<?php

include_once "Personne.php";
include_once "PersonneSecure.php";

// Création d'un objet Personne
$personne = new Personne("Martin", "Durand", "mdurand");
echo "Nom: " . $personne->getNom() . "\n";
echo "Prénom: " . $personne->getPrenom() . "\n";
echo "Login: " . $personne->getLogin() . "\n";

// Création d'un objet PersonneSecure
$personneSecure = new PersonneSecure("Alice", "Dupont", "adupont", "password123");
echo "Nom: " . $personneSecure->getNom() . "\n";
echo "Prénom: " . $personneSecure->getPrenom() . "\n";
echo "Login: " . $personneSecure->getLogin() . "\n";
echo "Mot de passe: " . $personneSecure->getMotDePasse() . "\n";

echo $personne . "\n";
echo $personneSecure . "\n";

echo $personne->toXML() . "\n";
echo $personneSecure->toXML() . "\n";