<?php

namespace sem2\3;

use Collection;
use Genre;
use sem2\use sem2\use sem2\use sem2\use sem2\include_once "Collection.php";
include_once "Genre.php";
include_once "Book.php";

class Shelf
{
    private int $idShelf;
    private Collection $genres;

    public function __construct(int $idShelf)
    {
        $this->idShelf = $idShelf;
        $this->genres = new Collection(Genre::class);
    }

    public function setGenre(Genre $genres): void
    {
        $this->genres->add($genres);
    }

    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function getIdShelf(): int
    {
        return $this->idShelf;
    }
}
?>