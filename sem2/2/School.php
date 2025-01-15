<?php
class Student
{
    private string $nom;
    private float $note;

    public function __construct(string $nom, float $note)
    {
        $this->nom = $nom;
        $this->note = $note;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getNote()
    {
        return $this->note;
    }
}

class StudyClass
{
    private array $students;
    private int $countStudents = 36;

    public function __construct()
    {
        $this->students = array_fill(0, count:  $this->countStudents, value: null);;
    }

    public function inputStudents()
    {
        $i = 0;
        $q="oui";
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
            if($i==36)
            {
                echo "Le nombre de student inscrit et au maximum, vous quittez la saisie !\n";
            }
        } while ($i < 36 && strtolower($q) != "non");
    }

    public function getStudents(): array
    {
        return $this->students;
    }

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

    public function getAVGNote()
    {
        $sumNote = 0;
        $sizeOff = 0;

        for($i=0;$i<count($this->students); $i++)
        {
            if($this->students[$i] != null)
            {
                $sizeOff = $sizeOff + 1;
                $sumNote = $sumNote + $this->students[$i]->getNote();
            }
        }

        $Moy = $sumNote / $sizeOff;
        return $Moy;
    }

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
}

$tabStudents = new StudyClass();

$tabStudents->inputStudents();

$idMax = $tabStudents->getIdofBestNote();
echo "Le student " . $tabStudents->getStudents()[$idMax]->getNom() . " a obtenu une note de " . $tabStudents->getStudents()[$idMax]->getNote() . " qui est la meilleurs !\n";

$idMin = $tabStudents->getIdofLessNote();
echo "Le student " . $tabStudents->getStudents()[$idMin]->getNom() . " a obtenu une note de " . $tabStudents->getStudents()[$idMin]->getNote() . " qui est la moins bonne !\n";

$MoyStud = $tabStudents->getAVGNote();
$comment = $tabStudents->getMoyComment($MoyStud);
echo "La moyenne des Students est de " . $MoyStud . $comment;

?>