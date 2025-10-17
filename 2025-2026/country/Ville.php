<?php

require_once "Pays.php";

class Ville {
    private int $id;
    private string $nom;
    private Pays $lePays;//objet Pays

    public function __construct(int $id, string $nom)
    {
        $this->id=$id;
        $this->nom=$nom;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getLePays(){
        return $this->lePays;
    }

    public function setLePays(Pays $lePays){
        $this->lePays=$lePays;

    }
    public function getNomPays(){
        return $this->lePays->getNom();
    }


}
?>