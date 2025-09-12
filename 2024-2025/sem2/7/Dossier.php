<?php

namespace sem2\7;

use sem2\use sem2\use sem2\class Dossier
{
    private
    string $nomPatient;
    private string $prenomPatient;
    private DateTime $dateNaissancePatient;
    private array $priseEnCharge; //mesprestations
    private int $nbPrestationsExternes = 0; // optionnel
    private int $nbPrestationsInternes = 0; // optionnel

    public function __construct(string $nomPatient, string $prenomPatient, DateTime $dateNaissancePatient)
{
    $this->nomPatient = $nomPatient;
    $this->prenomPatient = $prenomPatient;
    $this->dateNaissancePatient = $dateNaissancePatient;
    $this->priseEnCharge = [];
}

    /**
     * @return array
     */
    public function getPriseEnCharge(): array
{
    return $this->priseEnCharge;
}

    public function ajoutePrestation(string $libelle, DateTime $date, DateTime $heure, Intervenant &$intervenant)
{
    //Ref sur $intervenant pour ajouterPrestation, sinon pas d'effet
    $prestation = new Prestation($libelle, $date, $heure, $intervenant);
    $this->priseEnCharge[] = $prestation; // Ajout de la prestation au dossier patient
    $intervenant->ajouterPrestation($prestation); // Ajout de la prestation au dossier de l'intervenant
    if ($intervenant instanceof IntervenantExterne) // Optionnel
    {
        // Est ce que l'intervenant est de la classe IntervenantExterne
        $this->nbPrestationsExternes += 1;
    } else {
        //Sinon c'est un intervenant classique
        $this->nbPrestationsInternes += 1;
    }
}

    public function getNbPrestationsExternes(): int
{
    return $this->nbPrestationsExternes;
}

    public function getNbPrestations(): int
{
    return $this->nbPrestationsInternes;
}

    public function getNbJoursSoins(): int
{
    $prestation_distinct = [];
    foreach ($this->priseEnCharge as $prestation) {
        //(in_array) regarde si la date N'EST PAS dans le $prestation_distinct
        if (!in_array($prestation->getDateSoins(), $prestation_distinct)) {
            $prestation_distinct[] = $prestation->getDateSoins(); //Ajout dans $prestation_distinct
        }
    }
    return count($prestation_distinct); //Retourne le nombre de date unique
}
}

?>