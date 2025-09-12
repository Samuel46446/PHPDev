<?php

/*
 * Post de base pour le forum
 *
 * Un post contient :
 * - Un id de post (pno) (généré automatiquement)
 * - Un titre
 * - Une description
 * - Une version
 * - Un id d'utilisateur (uno)
 * - Un id de loader (lno)
 */

namespace sem2\_Project\registries;
class Post
{
    private string $title;
    private string $description;
    private string $version;
    private int $uno;
    private int $lno;

    public function __construct(string $title, string $description, string $version, int $uno, int $lno)
    {
        $this->title = $title;
        $this->description = $description;
        $this->version = $version;
        $this->uno = $uno;
        $this->lno = $lno;
    }

    public function getPno(): int
    {
        return $this->pno;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getUno(): int
    {
        return $this->uno;
    }

    public function getLno(): int
    {
        return $this->lno;
    }

    public function setPno(int $pno): void
    {
        $this->pno = $pno;
    }
}

?>