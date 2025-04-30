<?php
include_once "../../models/DroppingRegistry.php";
include_once "../../models/RegistryEntry.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["component"])) {

        $_SESSION['sendingComponent'] = true;
        DroppingRegistry::dropComponent($_POST['component']);
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
    <title>Modding Minecraft - Suppression de composant</title>
    <link rel="icon" href="../../textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
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
<h1 class="h1Tuto">Modding Minecraft : Supprimer un composant</h1>
    <?php echo "<div class=\"homeTuto\"><a href=\"../../index.php\" class=\"button-link\"><img src=\"../../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>"; ?>
<form action="DeleteComponent.php" method="POST">
    <?php
    if (isset($_SESSION['sendingComponent'])) {
        if ($_SESSION['sendingComponent']) {
            echo "<p class=\"pCopyright\">✅ Vous avez supprimer le composant.</p>";
            echo "<div class=\"home\"><a href=\"../../index.php\" class=\"button-link\"><img src=\"../../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"DeleteComponent.php\" class=\"button-link\"><img src=\"../../textures/retry.png\" alt=\"Recommencer avec un autre composant\" width=\"50\" height=\"50\"></a></div>";
            unset($_SESSION['sendingComponent']);
        } else if ($_SESSION['sendingComponent'] === false) {
            echo "<p class=\"pCopyright\">❌ Le composant n'a pas pu être supprimer, veuillez réessayer.</p>";
            echo "<a href=\"DeleteComponent.php\">Réessayer</a>";
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
        <button class="buttonDisco" type="submit">Supprimer le composant</button>
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