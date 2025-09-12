<?php

/*
 * Cette classe facilite la création d'un tutoriel
 *
 * Un tutoriel contient :
 * - Un titre
 * - Une version
 * - Un à propos
 * - Une description
 * - Une description finale
 *
 * Enfin il convient de noter qu'un tutoriel possède plusieurs composants
 * par exemple un tutoriel Block peut avoir des composants ayant pour nom javablock1
 * ou jsonblock1, ceci dépend du loader choisis par l'utilisateur, en l'occurrence
 * le loader minecraft fera en sorte que le composant soit affiché peut importe le loader
 * genre pour un fichier lang par exemple.
 */

namespace sem2\_ProjectVersionMVC\models;
class Tutorial
{
    private string $title;
    private string $version;
    private string $about;
    private string $description;
    private string $finalDesc;

    public function __construct(string $title, string $version, string $about, string $description, string $finalDesc)
    {
        $this->title = $title;
        $this->version = $version;
        $this->about = $about;
        $this->description = $description;
        $this->finalDesc = $finalDesc;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getAbout(): string
    {
        return $this->about;
    }

    /**
     * @return string
     */
    public function getFinalDesc(): string
    {
        return $this->finalDesc;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}

?>