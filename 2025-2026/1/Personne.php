<?php

include_once "XMLable.php";

class Personne implements XMLable
{
    private string $nom;
    private string $prenom;
    private string $login;

    public function __construct(string $nom, string $prenom, string $login)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->login = $login;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function __toString(): string
    {
        return $this->prenom . ' ' . $this->nom . ' ' . $this->login;
    }

    public function toXML()
    {
        $personneXML = simplexml_load_string('<personne/>');
        $personneXML->addChild('nom', $this->nom);
        $personneXML->addChild('prenom', $this->prenom);
        $personneXML->addChild('login', $this->login);
        return $personneXML->asXML();
    }
}