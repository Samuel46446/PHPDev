<?php
// DEBUT DE LA CLASS ACCOUNT
namespace sem2\1;

class Account //Nouvelle Objet Account
{
    private int $id; //Identifiant du compte
    private string $name; // Nom du client
    private string $surname; // Prénom du client
    private int $sold; // Le solde du dit client

    /**
     * Constructeur
     */
    public function __construct(int $id, string $name, string $surname, int $sold)
    {
        $this->id = $id; //private $id = $id du constructeur
        $this->name = $name;
        $this->surname = $surname;
        $this->sold = $sold;
    }

    /* Retourne le compte */
    public function getAccount()
    {
        return $this;
    }

    /* Retourne l'identifiant private */
    public function getId()
    {
        return $this->id;
    }

    /* Retourne le nom du client private */
    public function getName()
    {
        return $this->name;
    }

    /* Retourne le prénom du client private */
    public function getSurname()
    {
        return $this->surname;
    }

    /* Retourne le solde du client private */
    public function getSold()
    {
        return $this->sold;
    }

    /* Permet un transfert d'argent entre deux compte ($this donne et $account reçois)
    * Account &$account = Compte qui reçois (Référence/Adresse de compte)
    * si pas de Référence/Adresse &$account sera une copie de celui instancié
    * int $amount = solde que le $this va perdre et donner à $account
    * $compte1->giveSoldTo($compte2, 200);
    */
    public function giveSoldTo(Account &$account, int $amount)
    {
        if ($account != null && $this->withDrawSold($amount)) {
            $this->sold = $this->sold - $amount;
            $account->addSold($amount);
            echo "Transfert réussi avec succès ! \n";
        } else {
            echo "Transfert impossible ! \n";
        }
    }

    /* Modifie le solde pour ajouter de l'argent avec + $amount */
    private function addSold(int $amount)
    {
        $this->sold += $amount;
    }

    /* Modifie le solde avec une valeur $amount */
    private function setSold(int $amount)
    {
        $this->sold = $amount;
    }

    /* Vérifie si le solde est > 0 en changeant le $sold */
    private function withDrawSold(int $amount)
    {
        return $this->sold - $amount >= 0; // = if($this->sold - $amount >= 0) = bool
    }

    /* Augmente le solde de $this avec un pourcentage 
    * float $percentage = nombre à virgule
    * 1.x pour augmenter 0.x pour diminuer les valeurs
    */
    public function soldWithPercent(float $percentage)
    {
        $this->setSold($this->getSold() * $percentage);
    }

    /* Permet d'afficher l'état d'un compte dans un print ou echo 
    * ex : "Num : 1245 | Name : SMITH | Surname : Isabelle | Sold : 30000 | "
    * si un objet qui n'a pas __tostring est appelé dans un print ou un echo sa
    * donnera : 0xfhi0d (une adresse mémoire)
    */
    public function __tostring()
    {
        return "Num : " . $this->id . " | Name : " . $this->name . " | Surname : " . $this->surname . " | Sold : " . $this->sold . " | ";
    }
}// FIN DE LA CLASS ACCOUNT

// Déclaration d'objets Account
$a = new Account(1, "POMME", "Paul", 2000);
$b = new Account(2, "EXAMPLE", "Samuel", 500);
$c = new Account(3, "NULLNAME", "NULLSURNAME", 1000000);

//Affiche l'état des comptes (utilise le __tostring())
echo $a . "\n";
echo $b . "\n";
echo $c . "\n";

$percent = 1.10; //Pourcentage à param
$a->soldWithPercent($percent);
$b->soldWithPercent($percent);
$c->soldWithPercent($percent);

echo "Percentage + 10% \n";
echo $a . "\n";
echo $b . "\n";
echo $c . "\n";

echo "c donne à b et a \n";

$c->giveSoldTo($b, amount: 5000); // c donne 5000 à b
$c->giveSoldTo($a, amount: $c->getSold()); // Je prends le reste du solde c

// Vérification des modifs
echo $a . "\n";
echo $b . "\n";
echo $c . "\n";

?>