<?php

include_once "RegistryEntry.php";

/*
 * DroppingRegistry permet de supprimer des entrées de la base de données.
 *
 * Cette classe contient des méthodes statiques pour supprimer des composants, des tutoriels, des utilisateurs, des posts ou des réponses.
 *
 * Chaque méthode se connecte à la base de données, prépare une requête SQL pour supprimer l'entrée correspondante,
 * exécute la requête et gère les exceptions potentielles.
 *
 * Les méthodes acceptent des paramètres spécifiques pour identifier l'entrée à supprimer :
 * - dropComponent : cno (string)
 * - dropTutorial : tno (int)
 * - dropUser : uno (int)
 * - dropPost : id (int)
 * - dropReponse : rno (int), pno (int), uno (int)
 */
class DroppingRegistry
{
    public static function dropComponent(string $cno): void
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "DELETE FROM Components WHERE cno=:cno"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':cno', $cno, PDO::PARAM_STR);
            $stmt->execute(); // Exécution de la requête
        } catch (PDOException $e) {
            die("Erreur lors de la suppression du composant : " . $e->getMessage());
        }
    }

    public static function dropTutorial(int $tno): void
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "DELETE FROM Tutorials WHERE tno=:tno"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':tno', $tno, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête
        } catch (PDOException $e) {
            die("Erreur lors de la suppression du tutoriel : " . $e->getMessage());
        }
    }

    public static function dropUser(int $uno): void
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "DELETE FROM Users WHERE uno=:uno"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':uno', $uno, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête
        } catch (PDOException $e) {
            die("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        }
    }

    public static function dropPost(int $id) : void
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "DELETE FROM Post WHERE pno=:id"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête
        } catch (PDOException $e) {
            die("Erreur lors de la suppression du post : " . $e->getMessage());
        }
    }

    public static function dropReponse(int $rno, int $pno, int $uno): void
    {
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "DELETE FROM Reponse WHERE pno=:pno AND uno=:uno AND rno=:rno"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':pno', $pno, PDO::PARAM_INT);
            $stmt->bindValue(':uno', $uno, PDO::PARAM_INT);
            $stmt->bindValue(':rno', $rno, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête
        } catch (PDOException $e) {
            die("Erreur lors de la suppression de la réponse : " . $e->getMessage());
        }
    }
}

?>