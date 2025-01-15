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

    
}
?>