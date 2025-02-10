<?php

include_once "Collection.php";
include_once "Genre.php";
include_once "Shelf.php";
include_once "Book.php";

/*
* La Bookshelve prend un tableau de Shelf et la Shelf un tableaux de Book
*/
class Bookshelve
{    
    private Collection $bookshelves; // Shelf array

    public function __construct()
    {
        $this->bookshelves = new Collection(Shelf::class);
    }

    public function setShelves(Shelf... $shelf)
    {
        for( $i = 0; $i < count($shelf); $i++ )
        {
            $this->bookshelves->add($shelf[$i]);
        }
    }

    public function getGenrebyName(string $genre): Genre
    {
        for($j = 0; $j < $this->getBookshelves()->size(); $j++)
        {
            for ($i = 0; $i < $this->getBookshelves()->getObject($j)->getGenres()->size(); $i++)
            {
                if($this->getBookshelves()->getObject($j)->getGenres()->getObject($i)->getGenre() == $genre)
                {
                    return $this->getBookshelves()->getObject($j)->getGenres()->getObject($i);
                }
            }
        }
        return new Genre("NULL", new Shelf(-666));
    }

    public function newBook(string $title, string $genre)
    {
        $book = new Book($title, $this->getGenrebyName($genre));
        //print_r($book);
        return $book;
        /*for ($i = 0; $i < $this->getBookshelves()->size(); $i++)
        {
            $shelf = $this->getBookshelves()->getObject($i);
            if ($shelf === null) continue;
    
            for ($j = 0; $j < $shelf->getGenres()->size(); $j++)
            {
                $genreObj = $shelf->getGenres()->getObject($j);
                if ($genreObj instanceof Genre)
                {
                    if($genreObj->getGenre() === $genre)
                    {
                        $genreObj->placeBook(book: new Book($title, $genreObj));
                        return;    
                    }
                }
                else
                {
                    echo "erreur ce n'est pas un objet genre\n";
                }
            }
        }   */
    }

    public function getBookshelves(): Collection
    {
        return $this->bookshelves;
    }
}
?>