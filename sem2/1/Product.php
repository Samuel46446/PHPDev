<?php
class Product
{
    private int $id;
    private string $name;
    private float $price;
    private string $description;
    private float $tax;

    private static int $productRegistred = 0;
    private static ?Product $productExpensive = null;

    public function __construct(int $id, string $name, float $price, float $tax)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = "";
        $this->tax = $tax;
        self::$productRegistred = self::$productRegistred + 1;
        if (self::$productExpensive === null || self::$productExpensive->getPrice() < $price)
        {
            self::$productExpensive = $this;
        }
    }

    public static function getProductExpensive()
    {
        return self::$productExpensive ? self::$productExpensive->displayProduct() : "No product available.";
    }

    public function setDesc(string $text)
    {
        $this->description = $text;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getTaxRate()
    {
        return $this->tax;
    }

    public function getTaxToPrice()
    {
        return $this->price * $this->tax;
    }

    public function displayProduct()
    {
        return "Product -> ID : " . $this->id ." | Name : ". $this->name ." | Price : ". $this->price ." | Description : ". $this->description ." | Tax : ". $this->tax ." | ";
    }

    public static function displayRegistries()
    {
        return self::$productRegistred;
    }
}

$banane = new Product(1, "banana", 1.0, 1.10);
$banane->setDesc("Kart Slayer");
echo $banane->displayProduct() . "\n";

$dsNntendo = new Product(2, "ds", 50.0, 1.20);
$dsNntendo->setDesc("Double Screen !");
echo $dsNntendo->displayProduct() . "\n";

$wiiNntendo = new Product(3, "wii", 100.0, 1.20);
$wiiNntendo->setDesc("Revolution !");
echo $wiiNntendo->displayProduct() . "\n";


echo "Prix TTC : " . $banane->getTaxToPrice() . " €\n";
echo "Prix TTC : " . $dsNntendo->getTaxToPrice() . " €\n";
echo "Prix TTC : " . $wiiNntendo->getTaxToPrice() . " €\n";

echo "REGISTRIES ENTRY : " . Product::displayRegistries() ." Products \n";
echo "Expensive Product : " . Product::getProductExpensive() . "\n";
?>