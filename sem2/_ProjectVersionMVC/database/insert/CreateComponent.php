<?php
include_once "../../models/Component.php";
include_once "../../models/AttributeFetcher.php";
include_once "../../models/RegistryEntry.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["typeComposant"]) && !empty($_POST["cno"] && !empty($_POST["code"]) &&
        !empty($_POST["tutoriel"]) && !empty($_POST["description"]) && !empty($_POST["modLoader"]))) {

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

        RegistryEntry::buildComponentToBDD($component);
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
    <title>Modding Minecraft - Créer Composant</title>
    <link rel="icon" href="../../textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <link rel="stylesheet" type="text/css" href="../../css/title.css">
</head>
<body>
<?php
if (isset($_SESSION['user_id'], $_SESSION['username']))
{
if ($_SESSION['user_id'] === 1 && $_SESSION['username'] === "Admin")
{
?>
<h1 class="h1Tuto">Modding Minecraft : Créer un composant</h1>
    <form action="CreateComponent.php" method="POST">
    <?php
    if (isset($_SESSION['sendingComponent'])) {
        if ($_SESSION['sendingComponent']) {
            echo "<p class=\"pCopyright\">✅ Vous avez créé le composant.</p>";
            echo "<div class=\"home\"><a href=\"../../index.php\" class=\"button-link\"><img src=\"../../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"CreateComponent.php\" class=\"button-link\"><img src=\"../../textures/retry.png\" alt=\"Lien pour créer un autre composant\" width=\"50\" height=\"50\"></a></div>";
            unset($_SESSION['sendingComponent']);
        } else if ($_SESSION['sendingComponent'] === false) {
            echo "<p class=\"pCopyright\">❌ Le composant n'a pas pu être créé, veuillez réessayer.</p>";
            echo "<a href=\"CreateComponent.php\" title=\"Lien pour réessayer de créer un composant\">Réessayer</a>";
        }
    } else {
        ?>
        <?php echo "<div class=\"homeTuto\"><a href=\"../../index.php\" class=\"button-link\"><img src=\"../../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>"; ?>
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
        <button class="buttonDisco" type="submit">Créer le composant</button>
        <?php
    }
    ?>
</form>
    <?php
}
}
else
{
    echo "<p class=\"pCopyright\">❌ Vous n'avez pas les droits d'accès à cette page.</p>";
}
?>
</body>
</html>