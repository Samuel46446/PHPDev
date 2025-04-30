<?php

include_once "RegistryEntry.php";
include_once "AttributeFetcher.php";
include_once "Component.php";
include_once "Tutorial.php";
include_once "User.php";
include_once "Post.php";
include_once "Reponse.php";

/*
 * SwitchRegistry.php permet de mettre à jour les données dans la base de données.
 * Il contient des méthodes statiques pour mettre à jour les tutoriels, les composants, les utilisateurs, les posts ou les réponses.
 *
 * Les méthodes utilisent des requêtes préparées pour éviter les injections SQL.
 * Elles prennent en paramètre l'identifiant de l'élément à mettre à jour et l'objet contenant les nouvelles données.
 *
 * Chaque méthode se connecte à la base de données, prépare la requête SQL, lie les valeurs et exécute la requête.
 * En cas d'erreur, un message d'erreur est affiché.
 *
 * SwitchRegistry contient les méthodes suivantes :
 * - updateTutorialToBDD : met à jour un tutoriel dans la base de données
 * - updateComponentToBDD : met à jour un composant dans la base de données
 * - updateUserToBDD : met à jour un utilisateur dans la base de données
 * - updatePostToBDD : met à jour un post dans la base de données
 * - updateReponseToBDD : met à jour une réponse dans la base de données
 */
class SwitchRegistry
{
    public static function updateTutorialToBDD(int $tno, Tutorial $tutorial)
    {
        $sql = "";
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "UPDATE Tutorials SET title=:title, version=:version, about=:about, description=:description, finaldesc=:finaldesc WHERE tno=:tno";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':tno', $tno, PDO::PARAM_INT);
            $stmt->bindValue(':title', $tutorial->getTitle(), PDO::PARAM_STR);
            $stmt->bindValue(':version', $tutorial->getVersion(), PDO::PARAM_STR);
            $stmt->bindValue(':about', $tutorial->getAbout(), PDO::PARAM_STR);
            $stmt->bindValue(':description', $tutorial->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':finaldesc', $tutorial->getFinalDesc(), PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Le tutoriel n'a pas pu être modifié : " . $e->getMessage());
        }
        return $sql;
    }

    public static function updateComponentToBDD(string $cno, Component $component)
    {
        $sql = "";
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "UPDATE Components SET cno=:cno, description=:description, code=:code, lno=:lno WHERE cno=:val";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':val', $cno, PDO::PARAM_STR);
            $stmt->bindValue(':cno', $component->getCno(), PDO::PARAM_STR);
            $stmt->bindValue(':description', $component->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':code', $component->getCode(), PDO::PARAM_STR);
            $stmt->bindValue(':lno', $component->getLno(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Le composant n'a pas pu être modifié : " . $e->getMessage());
        }
        return $sql;
    }

    public static function updateUserToBDD(int $uno, User $user)
    {
        $sql = "";
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "UPDATE Users SET name=:name, email=:email, password=:password, phone=:phone WHERE uno=:uno";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':uno', $uno, PDO::PARAM_INT);
            $stmt->bindValue(':name', $user->getUsername(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(':phone', $user->getTelephone(), PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            die("L'utilisateur n'a pas pu être modifié : " . $e->getMessage());
        }
        return $sql;
    }

    public static function updatePostToBDD(int $pno, Post $post)
    {
        $sql = "";
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "UPDATE Post SET title=:title, description=:description, version=:version, uno=:uno, lno=:lno WHERE pno=:pno";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':pno', $pno, PDO::PARAM_INT);
            $stmt->bindValue(':title', $post->getTitle(), PDO::PARAM_STR);
            $stmt->bindValue(':description', $post->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':version', $post->getVersion(), PDO::PARAM_STR);
            $stmt->bindValue(':uno', $post->getUno(), PDO::PARAM_INT);
            $stmt->bindValue(':lno', $post->getLno(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Le post n'a pas pu être modifié : " . $e->getMessage());
        }
        return $sql;
    }

    public static function updateReponseToBDD(int $rno, int $pno, int $uno, Reponse $reponse)
    {
        $sql = "";
        try {
            $conn = RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "UPDATE Reponse SET msg=:msg WHERE rno=:rno AND pno=:pno AND uno=:uno";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':rno', $rno, PDO::PARAM_INT);
            $stmt->bindValue(':pno', $pno, PDO::PARAM_INT);
            $stmt->bindValue(':uno', $uno, PDO::PARAM_INT);
            $stmt->bindValue(':msg', $reponse->getText(), PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            die("La réponse n'a pas pu être modifiée : " . $e->getMessage());
        }
        return $sql;
    }
}

?>