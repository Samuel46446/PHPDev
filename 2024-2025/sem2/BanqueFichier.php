<?php

function add($filePath, $num, $nom, $prenom, $solde)
{
    // Ouvrir le fichier en mode "append" (ajout)
    if (($handle = fopen($filePath, "a")) !== false) {
        $data = [$num, $nom, $prenom, $solde];
        fputcsv($handle, $data, ";"); // Ajoute une ligne avec ";" comme délimiteur
        fclose($handle);
        echo "Données ajoutées avec succès.\n";
    } else {
        echo "Erreur : Impossible d'ouvrir le fichier pour écrire.\n";
    }
}

function displayAll($filePath)
{
    // Ouvrir le fichier en mode lecture
    if (($handle = fopen($filePath, "r")) !== false) {
        echo "Contenu du fichier CSV :\n";
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            // $data est un tableau contenant les colonnes de la ligne actuelle
            echo "Num : " . $data[0] . " | Nom : " . $data[1] . " | Prénom : " . $data[2] . " | Solde : " . $data[3] . "\n";
        }
        fclose($handle);
    } else {
        echo "Erreur : Impossible d'ouvrir le fichier pour lire.\n";
    }
}

function displaySpecific($filePath, $num)
{
    // Ouvrir le fichier en mode lecture
    if (($handle = fopen($filePath, "r")) !== false) {
        echo "Contenu du fichier CSV :\n";
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            // $data est un tableau contenant les colonnes de la ligne actuelle
            if($data[0] == $num)
            {
                echo "Num : " . $data[0] . " | Nom : " . $data[1] . " | Prénom : " . $data[2] . " | Solde : " . $data[3] . "\n";
            }
        }
        fclose($handle);
    } else {
        echo "Erreur : Impossible d'ouvrir le fichier pour lire.\n";
    }
}

function addMoney($filePath, $num, $sum)
{
    if (($handle = fopen($filePath, "w")) !== false) {
        echo "Contenu du fichier CSV :\n";
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            // $data est un tableau contenant les colonnes de la ligne actuelle
            if($data[0] == $num)
            {
                $data[2]=$data[2]+$sum;
                echo "Solde mis à jour : " . $data[2] . " €\n";
            }
        }
        fclose($handle);
    } else {
        echo "Erreur : Impossible d'ouvrir le fichier pour lire.\n";
    }
    /*foreach ($this->tabCompte as &$compte) {
        if ($compte["N°"] == $num) {
            $compte["Solde"] += $sum;
            echo "Solde mis à jour : " . $compte["Solde"] . " €\n";
            return;
        }
    }
    echo "Compte non trouvé.\n";*/
}

// Retirer du solde à un compte
function withdrawMoney($filePath, $num, $sum)
{
    if (($handle = fopen($filePath, mode: "w")) !== false) {
        echo "Contenu du fichier CSV :\n";
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            // $data est un tableau contenant les colonnes de la ligne actuelle
            if($data[0] == $num)
            {
                $data[2]=$data[2]-$sum;
                echo "Solde mis à jour : " . $data[2] . " €\n";
            }
        }
        fclose($handle);
    } else {
        echo "Erreur : Impossible d'ouvrir le fichier pour lire.\n";
    }
    /*
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
    echo "Compte non trouvé.\n";*/
}

function deleteAccount($filePath, $num)
{
    if (($handle = fopen($filePath, mode: "a")) !== false) {
        echo "Contenu du fichier CSV :\n";
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            // $data est un tableau contenant les colonnes de la ligne actuelle
            if($data[0] == $num)
            {
                $data[0] = [""];
                $data[1] = [""];
                $data[2] = [""];
                $data[3] = [""];
            }
        }
        fclose($handle);
    } else {
        echo "Erreur : Impossible d'ouvrir le fichier pour lire.\n";
    }
}

$filePath = "banqueAccount.csv";

do
{
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


    switch ($choix) 
    {
        case 1:
            echo "Entrer le numéro du compte : ";
            $num = trim(fgets(STDIN));
            echo "Entrer le nom : ";
            $nom = trim(fgets(STDIN));
            echo "Entrer le prénom : ";
            $prenom = trim(fgets(STDIN));
            echo "Entrer le solde : ";
            $solde = trim(fgets(STDIN));
            add($filePath,$num, $nom, $prenom, $solde);
            echo "Compte ajouté avec succès.\n";
            break;

        case 2:
            echo "Entrer le numéro du compte à supprimer : ";
            $num = trim(fgets(STDIN));
            deleteAccount($filePath, $num);
            break;

        case 3:
            echo "Entrer le numéro du compte : ";
            $num = trim(fgets(STDIN));
            echo "Entrer la somme à ajouter : ";
            $sum = (float) trim(fgets(STDIN));
            addMoney($filePath, $num, $sum);
            break;

        case 4:
            echo "Entrer le numéro du compte : ";
            $num = trim(fgets(STDIN));
            echo "Entrer la somme à retirer : ";
            $sum = (float) trim(fgets(STDIN));
            withdrawMoney($filePath,$num, $sum);
            break;

        case 5:
            echo "Entrez le numéro du compte à afficher : ";
            $num = trim(fgets(STDIN));
            displaySpecific($filePath, $num);
            break;

        case 6:
            displayAll(filePath: $filePath);
            break;
        case 7:
            echo "Merci d'avoir utilisé notre service. Au revoir !\n";
            break;

        default:
        echo "Choix invalide. Veuillez réessayer.\n";
    }
}
while($choix != 7);


$num = trim(fgets(STDIN));
$nom = trim(fgets(STDIN));
$prenom = trim(fgets(STDIN));
$solde = trim(fgets(STDIN));

// Ajouter une nouvelle ligne au fichier
add($filePath, $num, $nom, $prenom, $solde);

// Afficher le contenu du fichier
displayAll($filePath);

?>
