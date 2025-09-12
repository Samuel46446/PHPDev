<?php

use sem2\use sem2\use sem2\use sem2\use sem2\include_once 'Client.php';
include_once 'Employee.php';
include_once 'Grade.php';
include_once 'Intervention.php';
include_once 'Contract.php';

// Création d'un grade
$grade = new Grade("G1", "Senior Developer", 50.0);

// Création d'un employé
$employee = new Employee(1, "John Doe", $grade, "2020-01-01");

// Création d'un client
$client = new Client(1, "Acme Corporation", ["20 rue de l'End"], 1, "Ender", 2000);

// Création d'un contrat
$contract = new Contract(1, "2024-12-12", $client, 1, 20000);

// Création d'une intervention
$intervention = new Intervention(1, "2022-02-09", 300, 8.5, $employee);

// Affichage des informations
echo "Grade: " . $grade->getName() . " with hourly rate: " . $grade->hourlyRate() . "\n";
echo "Employee: " . $employee->getName() . " with grade: " . $employee->getGrade()->getName() . "\n";
echo "Client: " . $client->getName() . "\n";
echo "Contract: " . $contract->getNum() . " between " . $contract->getClient()->getName() . " and " . $contract->getClient()->getName() . "\n";
echo "Intervention: " . $intervention->getNum() . " on " . $intervention->getDate() . " for " . $intervention->getDuration() . " hours\n";

?>