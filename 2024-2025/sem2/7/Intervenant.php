<?php

namespace sem2\7;

use sem2\use sem2\class Intervenant
{
    private
    string $nom;
    private string $prenom;
    private array $prestations;

    public function __construct(string $nom, string $prenom)
{
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->prestations = [];
}

    /**
     * @return string
     */
    public function getNom(): string
{
    return $this->nom;
}

    /**
     * @return string
     */
    public function getPrenom(): string
{
    return $this->prenom;
}

    /**
     * @return array
     */
    public function getPrestations(): array
{
    return $this->prestations;
}

    /**
     * @param Prestation $prestation
     * @return void
     */
    public function ajouterPrestation(Prestation $prestation): void
{
    $this->prestations[] = $prestation;
}
}

?>