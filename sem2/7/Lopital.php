<?php

// Inclure les fichiers des classes
require_once 'Intervenant.php';
require_once 'IntervenantExterne.php';
require_once 'Prestation.php';
require_once 'Dossier.php';

// Création d'intervenants internes
$intervenantInterne = new Intervenant("Durand", "Pierre");
$intervenantInterne2 = new Intervenant("Fournier", "Émilie");

// Création d'intervenants externes
$intervenantExterne = new IntervenantExterne("Lacroix", "Jacques", "Orthopédie", "10 rue Principale", "0123456789");
$intervenantExterne2 = new IntervenantExterne("Morel", "Anne", "Cardiologie", "23 rue des Cœurs", "0987654321");

// Vérifier les infos de l'intervenant externe
echo "Infos de l'intervenant externe : \n";
echo "Nom : " . $intervenantExterne->getNom() . " " . $intervenantExterne->getPrenom() . "\n";
echo "Spécialité : " . $intervenantExterne->getSpecialite() . "\n";
echo "Adresse : " . $intervenantExterne->getAdresse() . "\n";
echo "Téléphone : " . $intervenantExterne->getTelephone() . "\n\n";

// Création d'un dossier patient
$dateNaissancePatient = new DateTime('1985-06-15');
$dossierPatient = new Dossier("Martin", "Julie", $dateNaissancePatient);

// Ajout de prestations (externe et interne)
$dossierPatient->ajoutePrestation(
    "Consultation Orthopédie",
    new DateTime('2024-02-10'),
    new DateTime('14:30'),
    $intervenantExterne
);

$dossierPatient->ajoutePrestation(
    "Suivi cardiologique",
    new DateTime('2024-02-10'),
    new DateTime('09:00'),
    $intervenantExterne2
);

$dossierPatient->ajoutePrestation(
    "Radiographie thoracique",
    new DateTime('2024-02-13'),
    new DateTime('11:15'),
    $intervenantInterne
);

$dossierPatient->ajoutePrestation(
    "Consultation générale",
    new DateTime('2024-02-14'),
    new DateTime('16:45'),
    $intervenantInterne2
);

// Afficher le nombre de prestations externes et internes
echo "Nombre de prestations externes : " . $dossierPatient->getNbPrestationsExternes() . "\n";
echo "Nombre de prestations internes : " . $dossierPatient->getNbPrestations() . "\n\n";

// Afficher les jours uniques de soins
echo "Nombre total de jours de soins pour le patient : " . $dossierPatient->getNbJoursSoins() . "\n\n";

// Affichage détaillé des prestations du dossier patient
echo "Liste détaillée des prestations pour le patient :\n";
foreach ($dossierPatient->getPriseEnCharge() as $prestation) {
    echo "- " . $prestation->getLibelle()
        . " le " . $prestation->getDateSoins()->format('d/m/Y')
        . " à " . $prestation->getHeureSoins()->format('H:i')
        . " (Intervenant : " . $prestation->getIntervenant()->getNom() . " " . $prestation->getIntervenant()->getPrenom()
        . ($prestation->getIntervenant() instanceof IntervenantExterne ?
            ", Spécialité : " . $prestation->getIntervenant()->getSpecialite() . ")" :
            ", Interne)")
        . "\n";
}

// Exemple d'accès aux prestations depuis l'intervenant lui-même
echo "\nPrestations assurées par l'intervenant externe Lacroix :\n";
foreach ($intervenantExterne->getPrestations() as $prestation) {
    echo "- " . $prestation->getLibelle()
        . " du " . $prestation->getDateSoins()->format('d/m/Y')
        . " à " . $prestation->getHeureSoins()->format('H:i') . "\n";
}