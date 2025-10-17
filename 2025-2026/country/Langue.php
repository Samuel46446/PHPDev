<?php
class Langue{
    private int $id;
    private string $nom;
    

    public function __construct(int $id, string $nom)
    {
        $this->id=$id;
        $this->nom=$nom;
    }

    public function getNom(){
        return $this->nom;
    }
}
?>