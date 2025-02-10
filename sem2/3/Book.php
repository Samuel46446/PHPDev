<?php

include_once "Collection.php";
include_once "Genre.php";

class Book
{
    private string $title; // Le titre du livre
    private Genre $genre; // Ajouter pour pouvoir prendre ce qu'il y a dans __construct

    /* Constructeur */
    public function __construct(string $bookTitle, Genre $bookGenre)
    {
        $this->title = $bookTitle;
        $this->genre = $bookGenre;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getGenre(): Genre
    {
        return $this->genre;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
?>