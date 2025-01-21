<?php
class Student //début de la class Student
{
    private string $name; // nom de l'élève
    private float $note; // note de l'élève

    /* Constructeur | les = "Unknow" et 0.0 sont des valeurs par défaut Student()*/
    public function __construct(string $nom = "Unknow", float $note = 0.0)
    {
        $this->name = $nom;
        $this->note = $note;
    }

    /* Retourne le nom de l'élève */
    public function getNom()
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
        $this->students = array_fill(0, count:  $this->countStudents, value: null);;
    }

    /* Fonction avec boucle qui permet d'enregitrer le nom et la note d'un élève*/
    public function inputStudents()
    {
        $i = 0;
        $q="oui"; // Par défaut la boucle continu
        do {
            echo "Entrez le nom du Student N°" . $i+1 . " : ";
            $nameStud = trim(fgets(STDIN));
            $noteStud = -1;
            do {
                echo "Entrez la note du Student N°" . $i+1 . " : ";
                $noteStud = trim(fgets(STDIN));
            } while ($noteStud < 0 || $noteStud > 20);

            $this->students[$i] = new Student($nameStud, $noteStud);
            $i++;
            echo "Voulez vous entrer un autre Student ('oui'|'non') : ";
            $q=trim(fgets(stream: STDIN));
            if($i==$this->countStudents)
            {
                echo "Le nombre de student inscrit et au maximum, vous quittez la saisie !\n";
            }
        } while ($i < $this->countStudents && strtolower($q) != "non");
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

        for($i=0;$i<count($this->students); $i++)
        {
            if($this->students[$i] != null)
            {
                if($this->students[$i]->getNote() > $maxNote)
                {
                    $maxNote = $this->students[$i]->getNote();
                    $idMaxNote=$i;
                }
            }
        }
        return $idMaxNote;
    }

    /* Retourne l'identifiant de l'élève qui a la note la moins bonne */
    public function getIdofLessNote()
    {
        $minVal = $this->students[$this->getIdofBestNote()]->getNote();
        $idMinNote = -1;

        for($i=0;$i<count($this->students); $i++)
        {
            if($this->students[$i] != null)
            {
                if($this->students[$i]->getNote() < $minVal)
                {
                    $minVal = $this->students[$i]->getNote();
                    $idMinNote=$i;
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

        for($i=0;$i<count($this->students); $i++)
        {
            // vérifie si l'id du tableau est un élève initialisé (donc non null)
            if($this->students[$i] != null)
            {
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

        if($Moy > 15)
        {
            $phrase = " c'est une très bonne moyenne !\n";
        }
        else if($Moy > 12.5)
        {
            $phrase = " c'est une bonne moyenne !\n";
        }
        else if($Moy > 10)
        {
            $phrase = " c'est dans la moyenne !\n";
        }
        else
        {
            $phrase = " c'est en dessous de la moyenne !\n";
        }

        return $phrase;
    }
}//fin de la class StudyClass

$tabStudents = new StudyClass(); // Initialisation d'une classe de 36 élèves
$tabStudents->inputStudents(); // On entre les élèves de cette classe

$idMax = $tabStudents->getIdofBestNote(); // Récupération de la meilleurs note via id
// Affichage de l'élève et de sa note
echo "Le student " . $tabStudents->getStudents()[$idMax]->getNom() . " a obtenu une note de " . $tabStudents->getStudents()[$idMax]->getNote() . " qui est la meilleurs !\n";

$idMin = $tabStudents->getIdofLessNote(); // Récupération de la moins bonne note via id
// Affichage de l'élève et de sa note
echo "Le student " . $tabStudents->getStudents()[$idMin]->getNom() . " a obtenu une note de " . $tabStudents->getStudents()[$idMin]->getNote() . " qui est la moins bonne !\n";

$MoyStud = $tabStudents->getAVGNote(); // Récupération de la moyenne
$comment = $tabStudents->getMoyComment($MoyStud);// Commentaire
echo "La moyenne des Students est de " . $MoyStud . $comment; // Affichage

?>