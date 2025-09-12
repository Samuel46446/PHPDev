<?php

use sem2\_Project\registries\SwitchRegistry;
use sem2\_ProjectVersionMVC\models\AttributeFetcher;
use sem2\_ProjectVersionMVC\models\RegistryEntry;
use sem2\_ProjectVersionMVC\models\Reponse;

include_once "../models/RegistryEntry.php";
include_once "../models/AttributeFetcher.php";
include_once "../models/SwitchRegistry.php";
include_once "../models/Reponse.php";

if (!isset($_SESSION)) {
    session_start();
}
$id = AttributeFetcher::getUserIdByName($_SESSION['username']);
$actualUser = RegistryEntry::getUserById($id);
$actualRep = AttributeFetcher::getRepondeById(intval($_GET['rno']), intval($_GET['pno']), $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modify'])) {
    if (!empty($_POST["msg"]))
    {
        $text = $_POST['msg'];
        $uno = $_SESSION['user_id'];
        $pno = intval($_GET['pno']);
        $rno = intval($_GET['rno']);

        $_SESSION['sendingPostChanges'] = true;

        $rep = new Reponse($text, $pno, $uno);

        SwitchRegistry::updateReponseToBDD($rno, $pno, $uno, $rep);
    }
    else
    {
        $_SESSION['sendingPostChanges'] = false;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Modding Minecraft - Mise à jour d'une réponse</title>
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
if (($_SESSION['user_id'] === 1 && $_SESSION['username'] === "Admin") || ($_SESSION['username'] === $_SESSION['userActual']->getUsername()))
{?>
<h1 class="h1Tuto">Modding Minecraft : Mise à jour de la réponse</h1>
<form action="UpdateReponse.php?pno=<?php echo $_GET['pno']; ?>&rno=<?php echo $_GET['rno']; ?>" method="POST">
    <?php
    if (isset($_SESSION['sendingPostChanges'])) {
        if ($_SESSION['sendingPostChanges']) {
            echo "<p class=\"pCopyright\">✅ Vous avez modifié le message.</p>";
            echo "<div class=\"home\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"../controllers/Posts.php?pno=".$_GET['pno']."\" class=\"button-link\"><img src=\"../textures/message.png\" alt=\"Lien pour revenir au post\" width=\"50\" height=\"50\"></a></div>";
        } else if ($_SESSION['sendingPostChanges'] === false) {
            echo "<p class=\"pCopyright\">❌ Le message n'a pas pu être modifié, veuillez réessayer.</p>";
            echo "<a href=\"../controllers/Posts.php?pno=".$_GET['pno']."\" title=\"Lien pour annuler la mise à jour et revenir au post\">Annuler</a>";
        }
    } else {
        ?>
        <label>
            <textarea class="buttonDisco" name="msg" placeholder="Réponse modifié" required><?php echo $actualRep['msg']; ?></textarea>
        </label>
        <button class="buttonDisco" type="submit" name="modify">Modifier la réponse</button>
        <?php
    }
    }
    }
    else
    {
        echo "<h1 class=\"h1TutoCenter\">Vous devez être connecté pour accéder à cette page.</h1>";
        echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
    }
    ?>
</form>
</body>
</html>