<?php

include_once "Map.php";

class Categorie
{
    private int $code;
    private string $libelle;
    private static array $lesCategories = [];

    public function __construct(int $code, string $libelle)
    {
        $this->code = $code;
        $this->libelle = $libelle;
        self::$lesCategories[$code] = $this;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public static function getLesCategories(): array
    {
        return self::$lesCategories;
    }
}