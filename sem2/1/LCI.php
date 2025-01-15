<?php
class Account
{
    private int $id;
    private string $name;
    private string $surname;
    private int $sold;

    public function __construct(int $id, string $name, string $surname, int $sold)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->sold = $sold;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getSold()
    {
        return $this->sold;
    }

    public function giveSoldTo(Account& $account, int $amount)
    {
        if($this->sold - $amount >= 0)
        {
            $this->withDrawSold($amount);
            $account->addSold($amount);
        }
        else
        {
            echo "Solde indisponible pour le transfert ! \n";
        }
    }

    public function addSold(int $amount)
    {
        $this->sold += $amount;
    }

    public function setSold(int $amount)
    {
        $this->sold = $amount;
    }

    public function withDrawSold(int $amount)
    {
        if($this->sold - $amount >= 0)
        {
            $this->sold -= $amount;
        }
        else
        {
            echo "Solde indisponible ! \n";
        }
    }

    public function soldWithPercent(float $percentage)
    {
        $this->setSold($this->getSold() * $percentage);
    }

    public function __tostring()
    {
        return "Num : " . $this->id ." | Name : ". $this->name ." | Surname : ". $this->surname ." | Sold : ". $this->sold ." | ";
    }
}

$a = new Account(1, "a", "aa", 2000);
$b = new Account(2, "b", "bb", 500);
$c = new Account(3, "c", "cc", 1000000);

echo $a . "\n";
echo $b . "\n";
echo $c . "\n";

$a->soldWithPercent(1.10);
$b->soldWithPercent(1.10);
$c->soldWithPercent(1.10);

echo "Percentage + 10% \n";
echo $a . "\n";
echo $b . "\n";
echo $c . "\n";

echo "c donne à b et a \n";

$c->giveSoldTo($b, amount: 5000);
$c->giveSoldTo($a, amount: 2500);
echo $a . "\n";
echo $b . "\n";
echo $c . "\n";

?>