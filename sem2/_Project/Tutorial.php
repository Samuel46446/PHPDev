<?php

class RegistryEntry
{
    private function __construct() {}

    public static function buildComponentToBDD(Component $component)
    {
        $sql = "";
        try {
            $conn = Main::connectSQL(); // Connexion à la base de données
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
            $conn = Main::connectSQL(); // Connexion à la base de données
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

    public function addTutorial(Tutorial $tutorial)
    {
        $this->tutorials[] = $tutorial;
    }

    public static function getTutorials()
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

    public function getTutorial(int $index)
    {
        return $this->tutorials[$index];
    }

    public function deleteTutorial(int $index)
    {
        unset($this->tutorials[$index]);
    }

    public function updateTutorial(int $index, Tutorial $tutorial)
    {
        $this->tutorials[$index] = $tutorial;
    }
}

class AttributeFetcher
{
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