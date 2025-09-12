<?php

include_once "Personne.php";

class PersonneSecure extends Personne
{
    private string $motDePasse;

    public function __construct(string $nom, string $prenom, string $login, string $motDePasse)
    {
        parent::__construct($nom, $prenom, $login);
        $this->motDePasse = $motDePasse;
    }

    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    public function __toString(): string
    {
        return parent::__toString() . ', Mot de passe: ' . $this->motDePasse;
    }

    public function toXML()
    {
        $personneXML = simplexml_load_string('<personneSecure/>');
        $personneXML->addChild('nom', $this->getNom());
        $personneXML->addChild('prenom', $this->getPrenom());
        $personneXML->addChild('login', $this->getLogin());
        $personneXML->addChild('motDePasse', $this->motDePasse);
        return $personneXML->asXML();
    }
}