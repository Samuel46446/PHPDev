<?php

class IntervenantExterne extends Intervenant
{
    private string $specialite;
    private string $adresse;
    private string $telephone;

    public function __construct(string $nom, string $prenom, string $specialite, string $adresse, string $telephone)
    {
        parent::__construct($nom, $prenom);
        $this->specialite = $specialite;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * @return string
     */
    public function getSpecialite(): string
    {
        return $this->specialite;
    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @param string $specialite
     */
    public function setSpecialite(string $specialite): void
    {
        $this->specialite = $specialite;
    }
}

?>