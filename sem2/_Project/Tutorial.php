<?php

include_once "BDDHelper.php";

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
            echo "✅ Utilisateur ajouté avec succès !";
        } catch (PDOException $e) {
            die("L'utilisateur ou l'adresse mail est déjà utiliser : " . $e->getMessage());
        }
        return $sql;
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
}

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
}

class AttributeFetcher
{
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

class Tutorial
{
    private string $title;
    private string $version;
    private string $about;
    private string $description;
    private string $finalDesc;

    public function __construct(string $title, string $version, string $about, string $description, string $finalDesc)
    {
        $this->title = $title;
        $this->version = $version;
        $this->about = $about;
        $this->description = $description;
        $this->finalDesc = $finalDesc;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getAbout(): string
    {
        return $this->about;
    }

    /**
     * @return string
     */
    public function getFinalDesc(): string
    {
        return $this->finalDesc;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}

class Component
{
    private string $cno;
    private string $description;
    private string $code;
    private int $lno;

    public function __construct(string $cno, string $description, string $code, int $lno)
    {
        $this->cno = $cno;
        $this->description = $description;
        $this->code = $code;
        $this->lno = $lno;
    }

    /**
     * @return string
     */
    public function getCno(): string
    {
        return $this->cno;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getLno(): int
    {
        return $this->lno;
    }
}

class User
{
    private string $username;
    private string $password;
    private string $email;
    private string $telephone;

    public function __construct(string $username, string $password, string $email, string $telephone)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }
}
?>