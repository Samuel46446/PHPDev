<?php

namespace sem2\2;

class Student //début de la class Student
{
    private string $name; // nom de l'élève
    private float $note; // note de l'élève

    /* Constructeur | les = "Unknow" et 0.0 sont des valeurs par défaut Student()*/
    public function __construct(string $nom = "Ghost", float $note = 0.0)
    {
        $this->name = $nom;
        $this->note = $note;
    }

    /* Retourne le nom de l'élève */
    public function getName()
    {
        return $this->name;
    }

    /* Retourne la note de l'élève */
    public function getNote()
    {
        return $this->note;
    }
}//fin de la class Student

class StudyClass //début de la class StudyClass
{
    private array $students; //Tableau $students déclaré
    private int $countStudents = 36; // Taille d'un classe (36)

    /* Constructeur | sans paramètre elle initialise toute les valeurs du tableau à null */
    public function __construct()
    {
        $this->students = [];
    }

    // Trier les élèves par rapport à leur note par ordre croissant
    public function sortStudents()
    {
        $tab1 = [];
        $j = 0;
        while ($tab1 != $this->students) {
            /* Première affectation importante car temps que les deux tableaux se 
            modifie la boucle ne s'arrête pas */
            $tab1 = $this->students;

            // Boucle importer du CCF Maths Python
            for ($i = 0; $i < count($this->students) - 1 - $j; $i++) {
                // Note inverser ce crochet à < donneras un ordre décroissant
                if ($this->students[$i]->getNote() > $this->students[$i + 1]->getNote()) {
                    $aux = $this->students[$i]; // Variable temporaire pour ne pas perdre l'élément
                    $this->students[$i] = $this->students[$i + 1]; // Déplacer la moins bonne note au début
                    $this->students[$i + 1] = $aux; // Déplacer la plus bonne note à la
                }
            }
            $j++;
        }
    }

    /* Fonction avec boucle qui permet d'enregitrer le nom et la note d'un élève*/
    public function inputStudents()
    {
        $i = 0;
        $q = "oui"; // Par défaut la boucle continu
        do {
            echo "Entrez le nom du Student N°" . $i + 1 . " : ";
            $nameStud = trim(fgets(STDIN));
            $noteStud = -1;
            do {
                echo "Entrez la note du Student N°" . $i + 1 . " : ";
                $noteStud = trim(fgets(STDIN));
            } while ($noteStud < 0 || $noteStud > 20);

            $this->students[] = new Student($nameStud, $noteStud);
            $i++;
            echo "Voulez vous entrer un autre Student ('oui'|'non') : ";
            $q = trim(fgets(stream: STDIN));
            $this->sortStudents();
            if ($i == $this->countStudents) {
                echo "Le nombre de student inscrit et au maximum, vous quittez la saisie !\n";
            }
        } while ($i < $this->countStudents - 1 && strtolower($q) != "non");
        //Tant que le max n'est pas atteint et que $q et différent de non
    }

    /* Retourne le tableau de $students */
    public function getStudents(): array
    {
        return $this->students;
    }

    /* Retourne l'identifiant de l'élève qui a la meilleur note */
    public function getIdofBestNote()
    {
        $maxNote = 0.0;
        $idMaxNote = -1;

        for ($i = 0; $i < count($this->students); $i++) {
            if ($this->students[$i] != null) {
                if ($this->students[$i]->getNote() > $maxNote) {
                    $maxNote = $this->students[$i]->getNote();
                    $idMaxNote = $i;
                }
            }
        }
        return $idMaxNote;
    }

    /* Récupére l'élève avec sont id dans le tableau */
    public function getStudentById($id)
    {
        if ($id >= 0 && $id < 36) {
            return $this->students[$id];
        }
        return new Student();
    }

    /* Supprime un élève en rentrant sont nom */
    public function deleteStudentsByName()
    {
        $choice = "oui"; // Choix de base | oui je veux continuer la boucle
        $name = ""; // Déclaration de variable utilisable après
        do {
            echo "Entrez le nom de l'élève à supprimer : ";
            $name = trim(fgets(stream: STDIN)); // Récupération du nom de l'élève
            $idFound = false;
            $idLocation = -1;

            for ($i = 0; $i < count($this->students); $i++) {
                if ($this->students[$i]->getName() == $name) {
                    $idFound = true;
                    $idLocation = $i; // Valeur par nom trouver
                }
            }

            if ($idFound) // La case du tableau d'élève à été trouver
            {
                for ($i = 0; $i < count($this->students); $i++) {
                    if ($idLocation == $i) {
                        $this->students[$i] = null; // Mettre à null la case
                        for ($j = $i; $j < count($this->students); $j++) {
                            // Remplacer les cases actuelle par les suivantes
                            if ($this->students[$j] == null && $j + 1 != count($this->students)) {
                                $this->students[$j] = $this->students[$j + 1];
                                // [E1, E2, E3] -> [E1, null, E3] -> [E1, E3, null]
                                //  0   1   2       0    1     2      0    1   2
                            }
                        }
                        unset($this->students[count($this->students) - 1]);
                        // unset supprime la dernière valeur du tableau
                        // cela permet de ne pas avoir de trou
                        // dans le précédent exemple la valeur 1 ne pourrais plus être accessible
                    }
                }
            }
            // Continuer de supprimer des élèves si ce n'est pas non cela recommencera la boucle
            echo "Voulez vous continuer la suppresion ('oui'|'non') : ";
            $choice = trim(fgets(stream: STDIN));
        } while ($choice != "non");
    }
    /* On aurait aussi pu avec un setNote mettre la note de l'élève à une valeur
    impossible par exemple (30) : 
    [10,15,16,20] -> je veux supprimer E1 alors -> E1.setNote(30) donne -> [15,16,20,30]
     E1 E2 E3 E4                                                            E2 E3 E4 E1
     unset(tab[count(tab)-1);*/

    /* Retourne l'identifiant de l'élève qui a la note la moins bonne */
    public function getIdofLessNote()
    {
        $minVal = $this->students[$this->getIdofBestNote()]->getNote();
        $idMinNote = -1;

        for ($i = 0; $i < count($this->students); $i++) {
            if ($this->students[$i] != null) {
                if ($this->students[$i]->getNote() < $minVal) {
                    $minVal = $this->students[$i]->getNote();
                    $idMinNote = $i;
                }
            }
        }
        return $idMinNote;
    }

    /* Retourne la moyenne des notes de tous les élèves */
    public function getAVGNote()
    {
        $sumNote = 0;
        $sizeOff = 0;

        for ($i = 0; $i < count($this->students); $i++) {
            // vérifie si l'id du tableau est un élève initialisé (donc non null)
            if ($this->students[$i] != null) {
                // Calcul la vrai taille du tableau (élève initialisé)
                $sizeOff = $sizeOff + 1;
                // Ajoute la note de l'élève à la somme
                $sumNote = $sumNote + $this->students[$i]->getNote();
            }
        }

        $Moy = $sumNote / $sizeOff; // Calcul de la Moyenne final
        return $Moy; // Renvoie la Moyenne
    }

    /* (Optionel) Permet d'obtenir une phrase sur l'état de la moyenne générale 
    de la classe, ex : Moy = 16 -> c'est une très bonne moyenne*/
    public function getMoyComment(float $Moy)
    {
        $phrase = "";

        if ($Moy > 15) {
            $phrase = " c'est une très bonne moyenne !\n";
        } else if ($Moy > 12.5) {
            $phrase = " c'est une bonne moyenne !\n";
        } else if ($Moy > 10) {
            $phrase = " c'est dans la moyenne !\n";
        } else {
            $phrase = " c'est en dessous de la moyenne !\n";
        }

        return $phrase;
    }

    public function displayStudents()
    {
        foreach ($this->students as $student) {
            if ($student != null) {
                echo "Student : " . $student->getName() . " " . $student->getNote() . " !";
            }
        }
    }
}//fin de la class StudyClass

$tabStudents = new StudyClass(); // Initialisation d'une classe de 36 élèves

$tabStudents->inputStudents(); // On entre les élèves de cette classe

echo $tabStudents->displayStudents() . "\n";
$tabStudents->deleteStudentsByName(); // Tentative de suppression d'élèves
echo $tabStudents->displayStudents() . "\n";

$idMax = $tabStudents->getIdofBestNote(); // Récupération de la meilleurs note via id
// Affichage de l'élève et de sa note
echo "Le student " . $tabStudents->getStudents()[$idMax]->getName() . " a obtenu une note de " . $tabStudents->getStudents()[$idMax]->getNote() . " qui est la meilleurs !\n";

$idMin = $tabStudents->getIdofLessNote(); // Récupération de la moins bonne note via id
// Affichage de l'élève et de sa note
echo "Le student " . $tabStudents->getStudents()[$idMin]->getName() . " a obtenu une note de " . $tabStudents->getStudents()[$idMin]->getNote() . " qui est la moins bonne !\n";

$MoyStud = $tabStudents->getAVGNote(); // Récupération de la moyenne
$comment = $tabStudents->getMoyComment($MoyStud);// Commentaire
echo "La moyenne des Students est de " . $MoyStud . $comment; // Affichage


?>