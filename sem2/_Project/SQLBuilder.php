<?php

enum Mode
{
    case SELECT;
    case INSERT;
    case UPDATE;
    case DELETE;
}

enum Result
{
    case FETCH;
    case FETCH_COLUMN;
    case FETCH_ALL;
}

#[AllowDynamicProperties] class SQLBuilder // Concept for build a SQL request
{
    private string $table;
    private Mode $mode;
    private array $insertVariables;
    private array $selectVariables;
    private array $updateVariables;
    private array $deleteVariables;
    private string $nameValue;
    private mixed $value;

    public function __construct() {}

    public function mode(Mode $mode): SQLBuilder
    {
        $this->mode = $mode;
        return $this;
    }

    public function table(string $table): SQLBuilder
    {
        $this->table = $table;
        return $this;
    }

    public function insertVars(mixed... $var): SQLBuilder
    {
        $this->insertVars = $var;
        return $this;
    }

    public function selectVars(string $val, mixed $realVal, mixed... $var): SQLBuilder
    {
        $this->nameValue = $val;
        $this->value = $realVal;
        $this->selectVars = $var;
        return $this;
    }

    public function updateVars(string $val, mixed... $var): SQLBuilder
    {
        $this->value = $val;
        $this->updateVars = $var;
        return $this;
    }

    public function deleteVars(string $val, mixed... $var): SQLBuilder
    {
        $this->value = $val;
        $this->deleteVars = $var;
        return $this;
    }



    public function build(Result $resultMod = Result::FETCH_ALL)
    {
        $conn = $this->connectSQL();

        switch ($this->mode)
        {
            case Mode::SELECT:
                $sql = "SELECT lno FROM Loaders";
                if(count($this->selectVariables) > 0)
                {
                    $sql = $sql . " WHERE ";
                    $tabVarID = [];
                    $tabVar = [];

                    for($i = 0; $i < count($this->selectVariables); $i++)
                    {
                        $sql = $sql . " $this->nameValue=:var" . $i;
                        $tabVarID[] = ':var'.$i;
                        $tabVar[] = $this->value;
                    }
                }
                //
                //WHERE name=:name"; // Requête SQL
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->execute(); // Exécution de la requête

                switch ($resultMod)
                {
                    case Result::FETCH:
                        return $stmt->fetch();

                    case Result::FETCH_ALL:
                        return $stmt->fetchAll();

                    case Result::FETCH_COLUMN:
                        return $stmt->fetchColumn();
                }
                break;
        }


    }

    protected function connectSQL()
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

}
?>