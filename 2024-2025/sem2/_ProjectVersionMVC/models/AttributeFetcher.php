<?php

namespace sem2\_ProjectVersionMVC\models;

use sem2\_ProjectVersionMVC\models\RegistryEntry;

include_once "RegistryEntry.php";

/*
 * AttributeFetcher.php permet de récupérer les attributs d'un post, d'une réponse, d'un loader, d'un utilisateur ou d'un tutoriel.
 *
 * Il contient des méthodes statiques pour interroger la base de données et retourner les résultats sous forme de tableau associatif.
 *
 * Les méthodes incluent :
 * - getResponseByIdPost(int $id) : Récupère toutes les réponses d'un post par son ID.
 * - getPostById(int $id) : Récupère un post par son ID.
 * - getRepondeById(int $rno, int $pno, int $uno) : Récupère une réponse par son ID de réponse, d'utilisateur et de post.
 * - getLoaderById(int $id) : Récupère le nom d'un loader par son ID.
 * - getUsernameById(int $id) : Récupère le nom d'un utilisateur par son ID.
 * - getUserIdByName(string $name) : Récupère l'ID d'un utilisateur par son nom.
 * - getTutorialIdByName(string $name) : Récupère l'ID d'un tutoriel par son nom.
 * - getLoaderIdByName(string $name) : Récupère l'ID d'un loader par son nom.
 * - getTutorialByName(string $name) : Récupère un tutoriel par son nom.
 * - getLogoLoaderById(int $id) : Récupère le logo d'un loader par son ID.
 */

class AttributeFetcher
{
    public static function getResponseByIdPost(int $id)
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Reponse WHERE pno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function getPostById(int $id)
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Post WHERE pno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un seul post sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération du post : " . $e->getMessage());
        }
    }

    public static function getRepondeById(int $rno, int $pno, int $uno)
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Reponse WHERE rno=:rno AND pno=:pno AND uno=:uno"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':rno', $rno, PDO::PARAM_INT);
            $stmt->bindValue(':pno', $pno, PDO::PARAM_INT);
            $stmt->bindValue(':uno', $uno, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetch(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function getLoaderById(int $id)
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT name FROM Loaders WHERE lno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function getUsernameById(int $id)
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT name FROM Users WHERE uno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function getUserIdByName(string $name)
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT uno FROM Users WHERE name=:name"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération de l'id de l'utilisateur : " . $e->getMessage());
        }
    }

    public static function getTutorialIdByName(string $name)
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT tno FROM Tutorials WHERE title=:name"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération de l'id du tuto : " . $e->getMessage());
        }
    }

    public static function getLoaderIdByName(string $name)
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT lno FROM Loaders WHERE name=:name"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération l'id du loader : " . $e->getMessage());
        }
    }

    public static function getTutorialByName(string $name)
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Tutorials WHERE title=:name"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetch(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération du tuto par le nom : " . $e->getMessage());
        }
    }

    public static function getLogoLoaderById(int $id)
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT icon FROM Loaders WHERE lno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération du logo par l'id : " . $e->getMessage());
        }
    }

}

?>