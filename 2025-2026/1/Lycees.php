<?php

class Lycees implements XMLable
{
    private static array $classrooms = [];

    public function __construct()
    {
    }

    public function addClassroom(Classroom $classroom): void
    {
        self::$classrooms[] = $classroom;
    }

    public function listClassrooms(): array
    {
        return self::$classrooms;
    }

    public function toXML(): string
    {
        $xml = "<lycees>\n";
        foreach (self::$classrooms as $classroom) {
            $xml .= $classroom->toXML() . "\n";
        }
        $xml .= "</lycees>";
        return $xml;
    }

    public function size(): int
    {
        return count(self::$classrooms);
    }

    public function nbrPersonne(): int
    {
        $total = 0;
        foreach (self::$classrooms as $classroom) {
            $total += $classroom->size();
        }
        return $total;
    }
}