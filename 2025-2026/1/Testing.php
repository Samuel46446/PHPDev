<?php

include_once "Personne.php";
include_once "PersonneSecure.php";
include_once "XMLable.php";
include_once "Classroom.php";
include_once "Lycees.php";
include_once "Entreprise.php";

// Création d'un objet Personne
$personne = new Personne("Martin", "Durand", "mdurand");
echo "Nom: " . $personne->getNom() . "\n";
echo "Prénom: " . $personne->getPrenom() . "\n";
echo "Login: " . $personne->getLogin() . "\n";
print("NB INSTANCE de PERSONNE : ".Personne::getNbInstance()."\n");

// Création d'un objet PersonneSecure
$personneSecure = new PersonneSecure("Alice", "Dupont", "adupont", "password123");
echo "Nom: " . $personneSecure->getNom() . "\n";
echo "Prénom: " . $personneSecure->getPrenom() . "\n";
echo "Login: " . $personneSecure->getLogin() . "\n";
echo "Mot de passe: " . $personneSecure->getMotDePasse() . "\n";

$personne2 = new Personne("Martine", "Durand", "mdurand");
print("NB INSTANCE de PERSONNE : ".Personne::getNbInstance()."\n");

echo $personne . "\n";
echo $personneSecure . "\n";

echo $personne->toXML() . "\n";
echo $personneSecure->toXML() . "\n";

function testXML(XMLable $obj): void
{
    echo $obj->toXML() . "\n";
}

testXML($personne);
testXML($personneSecure);

// Création d'une salle de classe et ajout des étudiants
$classroom = new Classroom();
$classroom->addStudent($personne);
$classroom->addStudent($personneSecure);
echo "Une Classe contient :\n";
echo $classroom->toXML() . "\n";

// Création d'un lycée et ajout de la salle de classe
$lycees = new Lycees();
$lycees->addClassroom($classroom);
echo "Un Lycée contient :\n";
echo $lycees->toXML() . "\n";

echo "Nombre de personnes dans le lycée : " . $lycees->nbrPersonne() . "\n";
echo "Nombre de classes dans le lycée : " . $lycees->size() . "\n";
echo "Nombre d'étudiants dans la classe : " . $classroom->size() . "\n";


$banque = new Entreprise("Banque");
echo "Nom de l'entreprise : " . $banque->getNom() . "\n";
$banque->addEmploye($personne);
$banque->addEmploye($personne2);
$banque->addEmploye($personneSecure);
echo "La Banque avec les employées :\n";
print_r($banque->getEmployes());
echo $banque->toXML() . "\n";

echo "Employés non sécurisés :\n";
print_r($banque->getPersonneNonSecure());
echo "Employés sécurisés :\n";
print_r($banque->getPersonneSecure());