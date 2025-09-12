<?php

use sem2\_ProjectVersionMVC\models\RegistryEntry;

include_once "RegistryEntry.php";

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