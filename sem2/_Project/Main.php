<?php

include_once "BDDHelper.php";

#[\JetBrains\PhpStorm\Deprecated] class Main
{
    public static string $NAME = "Minecraft Modding Helper";
    public static string $VERSION = "1.0.0";

    public static function connectSQL()
    {
        $login = BDDHelper::$login;
        $mdp = BDDHelper::$mdp;
        $bd = BDDHelper::$bd;
        $serveur = BDDHelper::$serveur;

        try {
            // Correction : utilisation de "pgsql" au lieu de "psql"
            $conn = new PDO("pgsql:host=$serveur;dbname=$bd", $login, $mdp, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Gestion des erreurs
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode de récupération par défaut
                PDO::ATTR_EMULATE_PREPARES => false, // Désactiver l'émulation des requêtes préparées
            ]);

            return $conn;
        } catch (PDOException $e) {
            die("Erreur de connexion PDO : " . $e->getMessage());
        }
    }

    public static function getAllPosts()
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Post"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function getReponseByIdPost(int $id)
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
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
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Post WHERE pno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un seul post sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération du post : " . $e->getMessage());
        }
    }

    public static function deletePostById(int $id)
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "DELETE FROM Post WHERE pno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête
        } catch (PDOException $e) {
            die("Erreur lors de la suppression du post : " . $e->getMessage());
        }
    }

    public static function getLoaderById(int $id)
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "SELECT name FROM Loaders WHERE lno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function getLogoLoaderById(int $id)
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "SELECT icon FROM Loaders WHERE lno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function getUserById(int $id)
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "SELECT name FROM Users WHERE uno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    private function __construct()
    {
    }
}

?>