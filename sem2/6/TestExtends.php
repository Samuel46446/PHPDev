<?php

class Picolo
{
    protected string $couleur; //Permet l'accès via l'héritage


    public function __construct(string $couleur)
    {
        $this->couleur = $couleur;
    }
}

class Picolo2 extends Picolo
{
    private string $nom;
    public function __construct(string $couleur, string $nom = "Picolo") // Picolo valeur par défaut
    {
        parent::__construct($couleur); // reprendre le constructeur
        //on peut aussi : parent::__construct("Bleu");
        $this->nom = $nom;
    }

    public function afficher()
    {
        echo $this->couleur;
    }
}