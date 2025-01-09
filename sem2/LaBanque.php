<?php
class Compte
{
    private $tabCompte = [];

    // Ajouter un compte
    public function add($num, $nom, $prenom, $solde)
    {
        $this->tabCompte[] = [
            "N°" => $num,
            "Nom" => $nom,
            "Prenom" => $prenom,
            "Solde" => (float) $solde
        ];
    }

    // Afficher tous les comptes
    public function displayAll()
    {
        if (empty($this->tabCompte)) {
            echo "Aucun compte disponible.\n";
            return;
        }

        foreach ($this->tabCompte as $compte) {
            echo "Num : " . $compte["N°"] . " | Nom : " . $compte["Nom"] . " | Prenom : " . $compte["Prenom"] . " | Solde : " . $compte["Solde"] . " €\n";
        }
    }

    // Afficher un compte spécifique
    public function displaySpecific($num)
    {
        foreach ($this->tabCompte as $compte) {
            if ($compte["N°"] == $num) {
                echo "Num : " . $compte["N°"] . "\n";
                echo "Nom : " . $compte["Nom"] . "\n";
                echo "Prenom : " . $compte["Prenom"] . "\n";
                echo "Solde : " . $compte["Solde"] . " €\n";
                return;
            }
        }
        echo "Compte non trouvé.\n";
    }

    // Supprimer un compte
    public function deleteAccount($num)
    {
        $initialCount = count($this->tabCompte);
        $this->tabCompte = array_filter($this->tabCompte, function ($compte) use ($num) {
            return $compte["N°"] != $num;
        });

        if (count($this->tabCompte) < $initialCount) {
            echo "Compte supprimé avec succès.\n";
        } else {
            echo "Compte introuvable.\n";
        }
    }

    // Ajouter du solde à un compte
    public function addMoney($num, $sum)
    {
        foreach ($this->tabCompte as &$compte) {
            if ($compte["N°"] == $num) {
                $compte["Solde"] += $sum;
                echo "Solde mis à jour : " . $compte["Solde"] . " €\n";
                return;
            }
        }
        echo "Compte non trouvé.\n";
    }

    // Retirer du solde à un compte
    public function withdrawMoney($num, $sum)
    {
        foreach ($this->tabCompte as &$compte) {
            if ($compte["N°"] == $num) {
                if ($compte["Solde"] >= $sum) {
                    $compte["Solde"] -= $sum;
                    echo "Retrait effectué. Nouveau solde : " . $compte["Solde"] . " €\n";
                } else {
                    echo "Fonds insuffisants.\n";
                }
                return;
            }
        }
        echo "Compte non trouvé.\n";
    }

    // Menu principal
    public function starting()
    {
        do {
            echo "\n=== Bienvenue dans votre banque ===\n";
            echo "1 : Ajouter un compte\n";
            echo "2 : Supprimer un compte\n";
            echo "3 : Ajouter du solde à un compte\n";
            echo "4 : Retirer du solde à un compte\n";
            echo "5 : Afficher un compte\n";
            echo "6 : Afficher tous les comptes\n";
            echo "7 : Quitter\n";
            echo "Votre choix : ";
            $choix = trim(fgets(STDIN));

            switch ($choix) {
                case 1:
                    echo "Entrer le numéro du compte : ";
                    $num = trim(fgets(STDIN));
                    foreach ($this->tabCompte as $compte) {
                        if ($compte["N°"] == $num) {
                            echo "Le numéro de compte existe déjà. Veuillez réessayer.\n";
                            continue 2;
                        }
                    }
                    echo "Entrer le nom : ";
                    $nom = trim(fgets(STDIN));
                    echo "Entrer le prénom : ";
                    $prenom = trim(fgets(STDIN));
                    echo "Entrer le solde : ";
                    $solde = trim(fgets(STDIN));
                    $this->add($num, $nom, $prenom, $solde);
                    echo "Compte ajouté avec succès.\n";
                    break;

                case 2:
                    echo "Entrer le numéro du compte à supprimer : ";
                    $num = trim(fgets(STDIN));
                    $this->deleteAccount($num);
                    break;

                case 3:
                    echo "Entrer le numéro du compte : ";
                    $num = trim(fgets(STDIN));
                    echo "Entrer la somme à ajouter : ";
                    $sum = (float) trim(fgets(STDIN));
                    $this->addMoney($num, $sum);
                    break;

                case 4:
                    echo "Entrer le numéro du compte : ";
                    $num = trim(fgets(STDIN));
                    echo "Entrer la somme à retirer : ";
                    $sum = (float) trim(fgets(STDIN));
                    $this->withdrawMoney($num, $sum);
                    break;

                case 5:
                    echo "Entrez le numéro du compte à afficher : ";
                    $num = trim(fgets(STDIN));
                    $this->displaySpecific($num);
                    break;

                case 6:
                    $this->displayAll();
                    break;

                case 7:
                    echo "Merci d'avoir utilisé notre service. Au revoir !\n";
                    break;

                default:
                    echo "Choix invalide. Veuillez réessayer.\n";
            }
        } while ($choix != 7);
    }
}

// Instanciation et lancement
$cmpte = new Compte();
$cmpte->starting();
?>
