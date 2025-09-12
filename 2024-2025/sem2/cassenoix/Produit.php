<?php

namespace sem2\cassenoix;
class Produit
{
    private string $variete;
    private string $type;
    private string $calibre;

    public function __construct(string $variete, string $type, string $calibre)
    {
        $this->variete = $variete;
        $this->type = $type;
        $this->calibre = $calibre;
    }

    public function getVariete(): string
    {
        return $this->variete;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCalibre(): string
    {
        return $this->calibre;
    }
}