<?php
class Produit {
    private string $ref;
    private string $nom;
    private int $prix;

    function __construct(string $ref, string $nom, int $prix) {
        $this->ref = $ref;
        $this->nom = $nom;
        $this->prix = $prix;
    }
    

    public function getRef(): string
    {
        return $this->ref;
    }

    public function getPrix(): int
    {
        return $this->prix;
    }
}
?>
