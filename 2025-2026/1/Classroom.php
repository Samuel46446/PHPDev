<?php

class Classroom implements XMLable
{
    private static array $students = [];

    public function __construct()
    {
    }

    public function addStudent(Personne $student): void
    {
        self::$students[] = $student;
    }

    public function listStudents(): array
    {
        return self::$students;
    }

    public function toXML(): string
    {
        $xml = "<classroom>\n";
        foreach (self::$students as $student) {
            $xml .= $student->toXML() . "\n";
        }
        $xml .= "</classroom>";
        return $xml;
    }

    public function size(): int
    {
        return count(self::$students);
    }
}