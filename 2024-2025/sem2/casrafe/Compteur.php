<?php

namespace sem2\casrafe;
class Compteur
{
    private int $oldIndex;
    private int $newIndex;

    public function __construct()
    {
        $this->oldIndex = 0;
        $this->newIndex = 0;
    }

    public function setNewIndex(int $newIndex): void
    {
        $this->newIndex = $newIndex;
    }

    public function setOldIndex(int $oldIndex): void
    {
        $this->oldIndex = $oldIndex;
    }

    public function getOldIndex(): int
    {
        return $this->oldIndex;
    }

    public function getNewIndex(): int
    {
        return $this->newIndex;
    }

    public function releve(): int
    {
        return $this->newIndex - $this->oldIndex;
    }
}