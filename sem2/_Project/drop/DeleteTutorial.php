<?php
include_once "../registries/DroppingRegistry.php";
include_once "../registries/AttributeFetcher.php";
include_once "../registries/RegistryEntry.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["tutorial"])) {
        $_SESSION['sendingComponent'] = true;
        $ID = AttributeFetcher::getTutorialIdByName($_POST['tutorial']);
        DroppingRegistry::dropTutorial($ID);
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
    <link rel="icon" href="../textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <link rel="stylesheet" type="text/css" href="../css/title.css">
</head>
<body>
<?php
if (isset($_SESSION['user_id'], $_SESSION['username']))
{
if ($_SESSION['user_id'] === 1 && $_SESSION['username'] === "Admin")
{
?>
<h1 class="h1Tuto">Modding Minecraft : Delete Tutorial</h1>
    <?php echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>"; ?>
    <form action="DeleteTutorial.php" method="POST">
    <?php
    if (isset($_SESSION['sendingComponent'])) {
        if ($_SESSION['sendingComponent']) {
            echo "<p class=\"pCopyright\">✅ Vous avez supprimer le tutoriel.</p>";
            echo "<div class=\"home\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"DeleteTutorial.php\" class=\"button-link\"><img src=\"../textures/retry.png\" alt=\"Retry\" width=\"50\" height=\"50\"></a></div>";
            unset($_SESSION['sendingComponent']);
        } else if ($_SESSION['sendingComponent'] === false) {
            echo "<p>❌ Le tutoriel n'a pas pu être supprimé, veuillez réessayer.</p>";
            echo "<a href=\"DeleteTutorial.php\">Réessayer</a>";
        }
    } else {
        ?>
        <label>
            <select name="tutorial" id="tutorial">
                <?php
                $currentComp = "Default";

                foreach (RegistryEntry::getTutorials() as $tuto) {
                    $selected = ($currentComp === $tuto['title']) ? "selected" : "";
                    echo "<option value=\"" . htmlspecialchars($tuto['title']) . "\" " . $selected . ">" . htmlspecialchars($tuto['title']) . "</option>";
                }

                ?>
            </select>
        </label>
        <button type="submit">Supprimer le tutoriel</button>
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