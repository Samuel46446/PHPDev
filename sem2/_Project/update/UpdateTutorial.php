<?php
include_once "../registries/Tutorial.php";
include_once "../registries/SwitchRegistry.php";
include_once "../registries/AttributeFetcher.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["title"]) && !empty($_POST["version"] &&
    !empty($_POST["about"]) && !empty($_POST["description"]) && !empty($_POST["finaldesc"]))) {
        $title = $_POST['title'];
        $version = $_POST['version'];
        $about = $_POST['about'];
        $description = $_POST['description'];
        $finalDesc = $_POST['finaldesc'];
        $_SESSION['sendingTutorial'] = true;

        $tutorial = new Tutorial($title, $version, $about, $description, $finalDesc);

        $id = AttributeFetcher::getTutorialIdByName($_POST['tutoriel']);
        SwitchRegistry::updateTutorialToBDD($id, $tutorial);
    }
    else
    {
        $_SESSION['sendingTutorial'] = false;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modding Minecraft - Modification de tutoriel</title>
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
<h1 class="h1Tuto">Modding Minecraft : Modifier le tutoriel</h1>
    <?php echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>"; ?>
    <form action="UpdateTutorial.php" method="POST">
    <?php
    if (isset($_SESSION['sendingTutorial'])) {
        if ($_SESSION['sendingTutorial']) {
            echo "<p class=\"pCopyright\">✅ Vous avez créé le tutoriel.</p>";
            echo "<div class=\"home\"><a href=\"UpdateTutorial.php\"" . $_SESSION['titleTutorial'] . "</a></div>";
        } else if ($_GET['sendingTutorial'] === false) {
            echo "<p class=\"pCopyright\">❌ Le tutoriel n'a pas pu être créé, veuillez réessayer.</p>";
            echo "<a href=\"UpdateTutorial.php\">Réessayer</a>";
        }
    } else {
        ?>
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
            <input class="buttonDisco" type="text" name="title" placeholder="Titre du tutoriel" required>
        </label>
        <label>
            <input class="buttonDisco" type="text" name="version" placeholder="Version Minecraft du tutoriel" required>
        </label>
        <label>
            <input class="buttonDisco" type="text" name="about" placeholder="Sujet du tutoriel" required>
        </label>
        <label>
            <input class="buttonDisco" type="text" name="description" placeholder="Description du tutoriel" required>
        </label>
        <label>
            <input class="buttonDisco" type="text" name="finaldesc" placeholder="Description final du tutoriel" required>
        </label>
        <button class="buttonDisco" type="submit">Modifier le tutoriel</button>
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