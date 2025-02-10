<?php

include_once "Collection.php";
include_once "Shelf.php";
include_once "Book.php";

class Genre
{
    private string $genre;
    private Shelf $shelf;
    private Collection $books;

    public function __construct(string $genre, Shelf $shelf)
    {
        $this->genre = $genre;
        $this->shelf = $shelf;
        $this->books = new Collection(Book::class);
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getShelf(): Shelf
    {
        return $this->shelf;
    }

    public function getBooks()
    {
        return $this->books;
    }

    private function rankBook(string $titleBook)
    {
        for ($i = 0; $i < $this->books->size(); $i++)
        {
            if($this->books->getObject($i) instanceof Book)
            {
                if($titleBook < $this->books->getObject(index: $i)->getTitle())
                {
                    return $i;
                }
            }
        }
    }

    public function setBooks(Book... $book)
    {
        for( $i = 0; $i < count($book); $i++ )
        {
            $this->books->add($book[$i]);
            if($this->books->size() > 1)
            {
                $this->placeBook($book[$i]);
            }
        }
    }

    public function placeBook(Book $book)
    {
        $this->books->deplace($this->rankBook($book->getTitle()), $book);
    }
}
?>