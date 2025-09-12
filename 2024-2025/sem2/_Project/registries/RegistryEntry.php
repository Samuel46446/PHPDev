<?php

use sem2\_Project\registries\Post;
use sem2\_ProjectVersionMVC\models\Component;
use sem2\_ProjectVersionMVC\models\Reponse;
use sem2\_ProjectVersionMVC\models\Tutorial;
use sem2\_ProjectVersionMVC\models\User;
use sem2\BDDHelper;

include_once __DIR__ . "/../../BDDHelper.php";
include_once "User.php";

class RegistryEntry
{
    private function __construct() {}

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

    public static function buildComponentToBDD(Component $component)
    {
        $sql = "";
        try {
            $conn = self::connectSQL(); // Connexion à la base de données
            $sql = "INSERT INTO Components(cno, description, code, lno) VALUES (:cno, :description, :code, :lno)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':cno', $component->getCno(), PDO::PARAM_STR);
            $stmt->bindValue(':description', $component->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':code', $component->getCode(), PDO::PARAM_STR);
            $stmt->bindValue(':lno', $component->getLno(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Le composant n'a pas pu être ajouté : " . $e->getMessage());
        }
        return $sql;
    }

    public static function buildTutorialToBDD(Tutorial $tutorial)
    {
        $sql = "";
        try {
            $conn = self::connectSQL(); // Connexion à la base de données
            $sql = "INSERT INTO Tutorials(title, version, about, description, finalDesc) VALUES (:title, :version, :about, :description, :finaldesc)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':title', $tutorial->getTitle(), PDO::PARAM_STR);
            $stmt->bindValue(':version', $tutorial->getVersion(), PDO::PARAM_STR);
            $stmt->bindValue(':about', $tutorial->getAbout(), PDO::PARAM_STR);
            $stmt->bindValue(':description', $tutorial->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':finaldesc', $tutorial->getFinalDesc(), PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Le tutoriel n'a pas pu être ajouté : " . $e->getMessage());
        }
        return $sql;
    }

    public static function buildPostToBDD(Post $post)
    {
        $sql = "";
        try {
            $conn = self::connectSQL(); // Connexion à la base de données
            $sql = "INSERT INTO Post(title, description, version, uno, lno) VALUES (:title, :description, :version, :uno, :lno)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':title', $post->getTitle(), PDO::PARAM_STR);
            $stmt->bindValue(':description', $post->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':version', $post->getVersion(), PDO::PARAM_STR);
            $stmt->bindValue(':uno', $post->getUno(), PDO::PARAM_INT);
            $stmt->bindValue(':lno', $post->getLno(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Le post n'a pas pu être ajouté : " . $e->getMessage());
        }
        return $sql;
    }

    public static function buildReponseToBDD(Reponse $reponse)
    {
        $sql = "";
        try {
            $conn = self::connectSQL(); // Connexion à la base de données
            $sql = "INSERT INTO Reponse(msg, pno, uno) VALUES (:msg, :pno, :uno)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':msg', $reponse->getText(), PDO::PARAM_STR);
            $stmt->bindValue(':pno', $reponse->getPno(), PDO::PARAM_INT);
            $stmt->bindValue(':uno', $reponse->getUno(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("La réponse n'a pas pu être ajoutée : " . $e->getMessage());
        }
        return $sql;
    }

    public static function buildUserToBDD(User $user)
    {
        //$resultat = -1;
        $sql = "";
        try {
            $conn = self::connectSQL(); // Connexion à la base de données
            $sql = "INSERT INTO Users(name, email, password, phone) VALUES (:name, :email, :password, :phone)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $user->getUsername(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(':phone', $user->getTelephone(), PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            die("L'utilisateur ou l'adresse mail est déjà utiliser : " . $e->getMessage());
        }
        return $sql;
    }

    public static function getPosts()
    {
        try {
            $conn = \sem2\_ProjectVersionMVC\models\RegistryEntry::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Post"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function getTutorials()
    {
        try {
            $conn = self::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Tutorials"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des tutos : " . $e->getMessage());
        }
    }

    public static function getComponents()
    {
        try {
            $conn = self::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Components"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des composants : " . $e->getMessage());
        }
    }

    public static function getUsers()
    {
        try {
            $conn = self::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Users"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
        }
    }

    public static function getUserById(int $uno)
    {
        try {
            $conn = self::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Users WHERE uno=:uno"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':uno', $uno, PDO::PARAM_INT);
            $stmt->execute(); // Exécution de la requête

            $tab = $stmt->fetch(PDO::FETCH_ASSOC);
            return new User($tab['name'], $tab['password'], $tab['email'], $tab['phone']);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération de l'utilisateur $uno : " . $e->getMessage());
        }
    }

    public static function getComponentsByTutorialNameAndLoader(int $loader, string $name)
    {
        try {
            $conn = self::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Components WHERE lno=:loader AND cno LIKE :name"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':loader', $loader, PDO::PARAM_INT);
            $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function getBaliseFromCno(string $cno, string $description, string $code, int $lno): string
    {
        if(str_contains($cno, "texture"))
        {
            return "<h2 class=\"h2Tuto\">". $description ."</h2> <img src=\"" . $code . "\" alt=\"" . $description . "\" style=\"image-rendering: pixelated; width: 200px; height: 200px;\">";
        }
        else if(str_contains($cno, "img"))
        {
            return "<div><img src=\"" . $code . "\" alt=\"" . $description . "\"></div>";
        }
        else if(str_contains($cno, "json"))
        {
            return "<h2 class=\"h2Tuto\">". $description ."</h2>
            <pre><code class=\"language-json\">". htmlspecialchars($code, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</code></pre>";
        }
        else if(str_contains($cno, "java"))
        {
            return "<h2 class=\"h2Tuto\">". $description ."</h2>
            <pre><code class=\"language-java\">". htmlspecialchars($code, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</code></pre>";
        }
        else
        {
            return "";
        }
    }

    public static function isUniqueUser(string $name, string $email) : bool
    {
        $isUnique = true;

        foreach (self::getUsers() as $allUser)
        {
            if($allUser['name'] == $name && $allUser['email'] == $email)
            {
                $isUnique = false;
            }
        }
        return $isUnique;
    }

}

?>