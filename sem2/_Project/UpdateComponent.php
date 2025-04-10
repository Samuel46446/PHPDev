<?php
include_once "Main.php";
include_once "Tutorial.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "post entree dans la fonction serv";
    var_dump($_POST); // 🔍 Affichage explicite avant tout traitement.
    if (!empty($_POST["typeComposant"]) && !empty($_POST["cno"] && !empty($_POST["code"]) &&
        !empty($_POST["tutoriel"]) && !empty($_POST["description"]) && !empty($_POST["modLoader"]))) {

        echo "post entree boucle";
        $typeComposant = $_POST['typeComposant'];
        $numComposant = $_POST['cno'];
        $tutorialName = $_POST['tutoriel'];
        $desc = $_POST['description'];
        $code = $_POST['code'];
        $modLoader = $_POST['modLoader'];

        $idModLoader = AttributeFetcher::getLoaderIdByName($modLoader);

        $_SESSION['sendingComponent'] = true;

        // first (imgblock1)
        $component = new Component($typeComposant.lcfirst($tutorialName).$numComposant, $desc, $code, $idModLoader);

        SwitchRegistry::updateComponentToBDD($_POST['component'], $component);
    }
    else
    {
        $_SESSION['sendingComponent'] = false;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Modding Minecraft</title>
    <link rel="icon" href="textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <style>
        h1 {
            color: #5CEB95;
            margin-left: 20px;
        }

        body {
            background-color: rgb(17, 17, 17);
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
        }

        p {
            color: #F525E3;
        }

        .home {
            margin-top: 20px;
        }

        input, button {
            padding: 10px;
            margin-top: 10px;
            display: block;
        }

        .home{
            width: 50px;
            height: 50px;
            cursor: pointer;
            background-color: #bd31d3;
        }

    </style>
</head>
<body>
<h1>Forum - Modding Minecraft : Update Component</h1>

<form action="UpdateComponent.php" method="POST">
    <?php
    if (isset($_SESSION['sendingComponent'])) {
        if ($_SESSION['sendingComponent']) {
            echo "<p>✅ Vous avez créé le composant.</p>";
            echo "<div class=\"home\"><a href=\"index.php\" class=\"button-link\"><img src=\"textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"UpdateComponent.php\" class=\"button-link\"><img src=\"textures/retry.png\" alt=\"Retry\" width=\"50\" height=\"50\"></a></div>";
            unset($_SESSION['sendingComponent']);
        } else if ($_SESSION['sendingComponent'] === false) {
            echo "<p>❌ Le composant n'a pas pu être créé, veuillez réessayer.</p>";
            echo "<a href=\"UpdateComponent.php\">Réessayer</a>";
        }
    } else {
        ?>
        <label>
            <select name="component" id="component">
                <?php
                $currentComp = "Default";

                foreach (RegistryEntry::getComponents() as $tuto) {
                    $selected = ($currentComp === $tuto['cno']) ? "selected" : "";
                    echo "<option value=\"" . htmlspecialchars($tuto['cno']) . "\" " . $selected . ">" . htmlspecialchars($tuto['cno']) . "</option>";
                }

                ?>
            </select>
        </label>
        <label>
            <select name="tutoriel" id="tutoriel">
                <?php
                $currentTuto = "Default";

                foreach (RegistryEntry::getTutorials() as $tuto) {
                    $selected = ($currentTuto === $tuto['title']) ? "selected" : "";
                    echo "<option value=\"" . htmlspecialchars($tuto['title']) . "\" " . $selected . ">" . htmlspecialchars($tuto['title']) . "</option>";
                }

                ?>
            </select>
        </label>
        <label>
            <select name="typeComposant" id="typeComposant">
            <option value="java" <?= ($_POST['typeComposant'] = "java") ? "selected" : ""; ?>>
                java
            </option>
            <option value="json" <?= ($_POST['typeComposant'] = "json") ? "selected" : ""; ?>>
                json
            </option>
            <option value="texture" <?= ($_POST['typeComposant'] = "texture") ? "selected" : ""; ?>>
                texture
            </option>
            <option value="img" <?= ($_POST['typeComposant'] = "img") ? "selected" : ""; ?>>
                img
            </option>
            </select>
        </label>
        <label>
            <input type="text" name="cno" placeholder="Numéro du Composant" required>
        </label>
        <label>
            <textarea id="description" name="description" placeholder="Description du Composant" required></textarea>
        </label>
        <label>
            <textarea id="code" name="code" placeholder="Code du Composant" required></textarea>
        </label>
        <label>
            <select name="modLoader" id="modLoader">
                <option value="forge" <?= ($_POST['modLoader'] == "forge") ? "selected" : ""; ?>>
                    forge
                </option>
                <option value="fabric" <?= ($_POST['modLoader'] == "fabric") ? "selected" : ""; ?>>
                    fabric
                </option>
                <option value="neoforge" <?= ($_POST['modLoader'] == "neoforge") ? "selected" : ""; ?>>
                    neoforge
                </option>
                <option value="minecraft" <?= ($_POST['modLoader'] == "minecraft") ? "selected" : ""; ?>>
                    minecraft
                </option>
            </select>
        </label>
        <button type="submit">Créer le composant</button>
        <?php
    }
    ?>
</form>
</body>
</html>