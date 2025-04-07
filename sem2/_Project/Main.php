<?php

include_once "BDDHelper.php";

class Main
{
    public static string $NAME = "Minecraft Modding Helper";
    public static string $VERSION = "1.0.0";

    public static int $BASEPOSTID = 0;

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

    public static function getComponentsByTutorialNameAndLoader(int $loader, string $name)
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
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

    public static function getTutorialFromName(string $name)
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Tutorials WHERE title=:name"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetch(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function getAllTutorials()
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Tutorials"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
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

    public static function getAllUsers()
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "SELECT * FROM Users"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public static function isUniqueUser(string $name, string $email) : bool
    {
        $isUnique = true;

        foreach (Main::getAllUsers() as $allUser)
        {
            if($allUser['name'] == $name && $allUser['email'] == $email)
            {
                $isUnique = false;
            }
        }
        return $isUnique;
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

            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un seul post sous forme de tableau associatif
        } catch (PDOException $e) {
            die("Erreur lors de la suppression du post : " . $e->getMessage());
        }
    }

    public static function getLoaderIdByName(string $name)
    {
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "SELECT lno FROM Loaders WHERE name=:name"; // Requête SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute(); // Exécution de la requête

            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des posts : " . $e->getMessage());
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

    public static function addUsers(string $name, string $email, string $password, string $phone)
    {
        //$resultat = -1;
        $sql = "";
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
            $sql = "INSERT INTO Users(name, email, password, phone) VALUES (:name, :email, :password, :phone)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
            $stmt->execute();
            echo "✅ Utilisateur ajouté avec succès !";
            //$resultat = $conn->lastInsertId(); // Récupère l'ID du dernier utilisateur inséré
//            return $stmt->fetchColumn(); // Récupération des résultats sous forme de string
        } catch (PDOException $e) {
            die("L'utilisateur ou l'adresse mail est déjà utiliser : " . $e->getMessage());
        }
        return $sql;
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

    public static string $CHEVRONL = "&lt;";
    public static string $CHEVRONR = "&gt;";

    public static function getBaliseFromCno(string $cno, string $description, string $code, int $lno): string
    {
        if(str_contains($cno, "texture"))
        {
            return "<h2>". $description ."</h2> <img src=\"" . $code . "\" alt=\"" . $description . "\" style=\"image-rendering: pixelated; width: 200px; height: 200px;\">";
        }
        else if(str_contains($cno, "img"))
        {
            return "<div><img src=\"" . $code . "\" alt=\"" . $description . "\"></div>";
        }
        else if(str_contains($cno, "json"))
        {
            return "<h2>". $description ."</h2>
            <pre><code class=\"language-json\">". htmlspecialchars($code, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</code></pre>";
        }
        else if(str_contains($cno, "java"))
        {
            return "<h2>". $description ."</h2>
            <pre><code class=\"language-java\">". htmlspecialchars($code, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</code></pre>";
        }
        else
        {
            return "";
        }
    }

    public static function getLoaderFrom(string $modLoader, string $componentForge, string $componentFabric, string $componentNeoforge, string $componentMinecraft): string
    {
        if($modLoader == "forge")
        {
            return  htmlspecialchars($componentForge);
        }
        else if($modLoader == "fabric")
        {
            return  htmlspecialchars($componentFabric);
        }
        else if($modLoader == "neoforge")
        {
            return htmlspecialchars($componentNeoforge);
        }
        else
        {
            return htmlspecialchars($componentMinecraft);
        }
    }
}

?>