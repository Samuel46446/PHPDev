<?php

require_once "Ville.php";

class Pays
{
    private int $id;
    private string $nom;
    private array $lesVilles; //tableau d'objets Ville
    private Ville $laCapitale; //objet Ville
    private array $lesLangues; //tableau d'objets Langue + booleen estOfficielle

    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom=$nom;
        $this->lesVilles = [];
        $this->lesLangues = [];
    }

    public function ajouterVille(Ville $uneVille)
    {
        $uneVille->setLePays($this);
        $this->lesVilles[] = $uneVille;
    }

    public function setLaCapitale(Ville $uneVille){
        $this->laCapitale=$uneVille;
    }
    public function ajouterLangue(Langue $uneLangue, bool $estOfficielle)
    {
        $this->lesLangues[] = [
            "lang" => $uneLangue,
            "official" => $estOfficielle
        ];
    }
    
    public function getNomCapitale(){
        return $this->laCapitale->getNom();
    }

    public function getNom(){
        return $this->nom;
    }

    public function getLangueNonOfficielle(): array
    {
        $notOfficialLangs = [];
        foreach ($this->lesLangues as $lang) {
            if(!$lang["official"])
            {
                $notOfficialLangs[] = $lang["lang"];
            }
        }
        return $notOfficialLangs;
    }
}
