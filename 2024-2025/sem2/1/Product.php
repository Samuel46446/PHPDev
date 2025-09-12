<?php

namespace sem2\1;

class Product // DEBUT DE LA CLASS Product
{
    private int $id; // id du produit
    private string $name; // nom du produit
    private float $price; // prix
    private string $description; // description du produit (optionel)
    private float $tax; // la tax (TVA) sur le produit à l'achat

    /*Variables protected dans le cas ou on extends l'objet et qu'on en aurais besoins 
    *Exemple : class Console extends Product pour avoir le nombre de console acheter*/
    private static int $productRegistred = 0; // nombre de produits instanciés
    private static ?Product $productExpensive = null; // Le produit le plus cher

    /* Constructeur */
    public function __construct(int $id, string $name, float $price, float $tax)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = "";
        $this->tax = $tax;
        self::$productRegistred = self::$productRegistred + 1; // +1 Product Registred
        /* Vérifie si le produit est null OU qu'il est plus cher alors il instancie 
        le $productExpensive avec l'objet */
        if (self::$productExpensive === null || self::$productExpensive->getPrice() < $this->price) {
            self::$productExpensive = $this;
            // Le produit $this est plus cher donc $productExpensive = $this
        }
    }

    /* Retourne le produit le plus cher, s'il est null il ne s'affichera pas */
    public static function getProductExpensive()
    {
        /* if and else en 1 ligne ex: isFood ? "Food" : "No Food";*/
        // self::$productExpensive = if(self::$productExpensive != null)
        return self::$productExpensive ? self::$productExpensive->displayProduct() : "No product available.";
    }

    /* Instancie la description (attribut private) */
    public function setDesc(string $text)
    {
        $this->description = $text;
    }

    /* Retourne la description (attribut private) */
    public function getDescription()
    {
        return $this->description;
    }

    /* Retourne la id (attribut private) */
    public function getId()
    {
        return $this->id;
    }

    /* Retourne la name (attribut private) */
    public function getName()
    {
        return $this->name;
    }

    /* Retourne le price (attribut private) */
    public function getPrice()
    {
        return $this->price;
    }

    /* Retourne la tax (attribut private) */
    public function getTaxRate()
    {
        return $this->tax;
    }

    /* Retourne le prix TTC */
    public function getTaxToPrice()
    {
        return $this->price * $this->tax;
    }

    /* Affiche un produit avec sont id, prix etc... */
    public function displayProduct()
    {
        return "Product -> ID : " . $this->id . " | Name : " . $this->name . " | Price : " . $this->price . " | Description : " . $this->description . " | Tax : " . $this->tax . " | ";
    }

    /* Renvoie le nombre de produit enregistrés */
    public static function displayRegistries()
    {
        return self::$productRegistred;
    }
}// FIN DE LA CLASS Product

//Déclaration d'une banane qui coute 1.0 et à une tva de 10%
$banane = new Product(1, "banana", 1.0, 1.10);
$banane->setDesc("Kart Slayer"); //Optionel
echo $banane->displayProduct() . "\n"; //Affichage

//Déclaration d'une ds qui coute 50.0 et à une tva de 20%
$dsNntendo = new Product(2, "ds", 50.0, 1.20);
$dsNntendo->setDesc("Double Screen !"); //Optionel
echo $dsNntendo->displayProduct() . "\n"; //Affichage

//Déclaration d'une wii qui coute 100.0 et à une tva de 20%
$wiiNntendo = new Product(3, "wii", 100.0, 1.20);
$wiiNntendo->setDesc("Revolution !"); //Optionel
echo $wiiNntendo->displayProduct() . "\n"; //Affichage

//Afficher les Produits TTC
echo "Prix TTC : " . $banane->getTaxToPrice() . " €\n";
echo "Prix TTC : " . $dsNntendo->getTaxToPrice() . " €\n";
echo "Prix TTC : " . $wiiNntendo->getTaxToPrice() . " €\n";

// Pour avoir accès aux méthodes public static on utilise ::
echo "REGISTRIES ENTRY : " . Product::displayRegistries() . " Products \n";
echo "Expensive Product : " . Product::getProductExpensive() . "\n";
?>