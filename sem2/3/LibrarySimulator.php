<?php
include_once "Genre.php";
include_once "Shelf.php";
include_once "Book.php";
include_once "Bookshelve.php";

$debug = false;

$library = new Bookshelve(); // Création de la bibliothèque

/* Création des étagères */
$shelfPolicier = new Shelf(1); // Policier
$shelfRoman = new Shelf(2); // Roman
$shelfPoesie = new Shelf(3); // Poésie
$shelfBD = new Shelf(4); // BD
$shelfDrama = new Shelf(5); // Dramatique
$shelfThea = new Shelf(6); // Thèatrale
$shelfScifi = new Shelf(7); // Science-fiction
$shelfFanta = new Shelf(8); // Fantastique

/* Création des genres */
$policier = new Genre(genre: "policier", shelf: $shelfPolicier);
$roman = new Genre(genre: "roman", shelf: $shelfRoman);
$poesie = new Genre(genre: "poesie", shelf: $shelfPoesie);
$bd = new Genre(genre: "bd", shelf: $shelfBD);
$drama = new Genre(genre: "dramatique", shelf: $shelfDrama);
$thea = new Genre(genre: "theatre", shelf: $shelfThea);
$scifi = new Genre(genre: "science-fiction", shelf: $shelfScifi);
$fanta = new Genre(genre: "fantastique", shelf: $shelfFanta);

/* Ajout des genres aux étagères */
$shelfPolicier->setGenre(genres: $policier);
$shelfRoman->setGenre(genres: $roman);
$shelfPoesie->setGenre(genres: $poesie);
$shelfBD->setGenre(genres: $bd);
$shelfDrama->setGenre(genres: $drama);
$shelfThea->setGenre(genres: $thea);
$shelfScifi->setGenre(genres: $scifi);
$shelfFanta->setGenre(genres: $fanta);

/* Ajout des étagères à la bibliothèque */
$library->setShelves($shelfPolicier, $shelfRoman, $shelfPoesie, $shelfBD, 
$shelfDrama, $shelfThea, $shelfScifi, $shelfFanta);

/* Debug */
if($debug)
{
    echo "------------------------------------\n";
    echo "Debug Biblio/Shelves\n";
    echo "------------------------------------\n";

    print_r($library);
    print_r($shelfPolicier);
    print_r($shelfRoman);
    print_r($shelfPoesie);
    print_r($shelfBD);
    print_r($shelfDrama);
    print_r($shelfThea);
    print_r($shelfScifi);
    print_r($shelfFanta);
}

echo "------------------------------------\n";
echo "Étagères avec leurs genres\n";
echo "------------------------------------\n";
/* Affichage des genres de chaque étagère */
for($i = 0; $i < $library->getBookshelves()->size(); $i++)
{
    echo "Etagère n°" . $library->getBookshelves()->getObject($i)->getIdShelf() . "\n";

    for($j = 0; $j < $library->getBookshelves()->getObject($i)->getGenres()->size(); $j++)
    {
        echo "Genres : " . $library->getBookshelves()->getObject($i)->getGenres()->getObject($j)->getGenre() . "\n";
    }
}

echo "-------------------------------------------\n";
echo "J'essaye de retrouver le genre par le nom\n";
echo "--------------------------------------------\n";
/* Retrouver un genre par son nom */
$aGenre = $library->getGenrebyName("policier");
echo $aGenre->getGenre() . "\n";

echo "------------------------------------\n";
echo "Ajout de livres\n";
echo "------------------------------------\n";
/* Création de livres */
$book1 = $library->newBook("Le Crime de l'Orient-Express", $policier->getGenre());
$book2 = $library->newBook("Les Misérables", $roman->getGenre());
$book3 = $library->newBook("Les Fleurs du mal", $poesie->getGenre());
$book4 = $library->newBook("Tintin au Tibet", $bd->getGenre());
$book5 = $library->newBook("Hamlet", $drama->getGenre());
$book6 = $library->newBook("Le Malade imaginaire", $thea->getGenre());
$book7 = $library->newBook("Dune", $scifi->getGenre());
$book8 = $library->newBook("Harry Potter à l'école des sorciers", $fanta->getGenre());

/* Ajout des livres aux genres */
$policier->setBooks($book1);
$roman->setBooks($book2);
$poesie->setBooks($book3);
$bd->setBooks($book4);
$drama->setBooks($book5);
$thea->setBooks($book6);
$scifi->setBooks($book7);
$fanta->setBooks($book8);

if($debug)
{
    echo "------------------------------------\n";
    echo "Debug Books\n";
    echo "------------------------------------\n";

    print_r($book1);
    print_r($book2);
    print_r($book3);
    print_r($book4);
    print_r($book5);
    print_r($book6);
    print_r($book7);
    print_r($book8);
}

echo "------------------------------------\n";
echo "Affichage Étagères->Genres->Livres\n";
echo "------------------------------------\n";
/* Triple boucle pour afficher les livres de chaque genre de chaque étagère */
for($i = 0; $i < $library->getBookshelves()->size(); $i++)
{
    echo "------------------------------------\n";
    echo "$i\n";
    echo "------------------------------------\n";

    echo "Etagère n°" . $library->getBookshelves()->getObject($i)->getIdShelf() . "\n";

    for($j = 0; $j < $library->getBookshelves()->getObject($i)->getGenres()->size(); $j++)
    {
        echo "  ------------------------------------\n";
        echo "      $j\n";
        echo "  ------------------------------------\n";
    
        echo "Genres : " . $library->getBookshelves()->getObject($i)->getGenres()->getObject($j)->getGenre() . "\n";

        for($k = 0; $k < $library->getBookshelves()->getObject($i)->getGenres()->getObject($j)->getBooks()->size(); $k++)
        {
            echo "      ------------------------------------\n";
            echo "          $k\n";
            echo "      ------------------------------------\n";
    
            echo "Livre : " . $library->getBookshelves()->getObject($i)->getGenres()->getObject($j)->getBooks()->getObject($k)->getTitle() . "\n";
        }
    }
}

echo "  ------------------------------------\n";
echo "              FIN\n";
echo "  ------------------------------------\n";
?>