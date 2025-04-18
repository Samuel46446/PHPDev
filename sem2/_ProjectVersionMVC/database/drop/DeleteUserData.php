<?php
include_once "../../models/DroppingRegistry.php";
include_once "../../models/AttributeFetcher.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["raison"])) {
        $ID = AttributeFetcher::getUserIdByName($_SESSION['username']);
        if ($ID) {
            DroppingRegistry::dropUser($ID);
            $_SESSION['sendingUserDrop'] = true;
            session_destroy();
        } else {
            $_SESSION['sendingUserDrop'] = false; // ID utilisateur introuvable
        }
    }
    else {
        $_SESSION['sendingUserDrop'] = false; // Nom d'utilisateur non défini dans la session
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Modding Minecraft</title>
    <link rel="icon" href="../../textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <link rel="stylesheet" type="text/css" href="../../css/title.css">
</head>
<body>
<?php
if (isset($_SESSION['user_id'], $_SESSION['username']) && ($_SESSION['user_id'] != 1 && $_SESSION['username'] != "Admin"))
{ ?>
<h1 class="h1Tuto">Modding Minecraft : Supprimer le compte</h1>
<form action="DeleteUserData.php" method="POST">
    <?php
    if (isset($_SESSION['sendingUserDrop'])) {
        if ($_SESSION['sendingUserDrop']) {
            echo "<p class=\"pCopyright\">✅ Vous avez supprimé le compte.</p>";
            echo "<div class=\"home\"><a href=\"../../index.php\" class=\"button-link\"><img src=\"../../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
            unset($_SESSION['sendingUserDrop']);
        } else if ($_SESSION['sendingUserDrop'] === false) {
            echo "<p class=\"pCopyright\">❌ Le compte n'a pas pu être supprimé, veuillez réessayer.</p>";
            echo "<a href=\"DeleteUserData.php\" title=\"Lien pour réessayer de supprimer l'utilisateur\">Réessayer</a>";
        }
    } else {
        ?>
        <label>
            <input class="buttonDisco" type="text" name="raison" placeholder="Raison de la suppression" required>
        </label>
        <label>
            <button class="buttonDisco" type="submit">Supprimer le compte</button>
        </label>
        <?php
    }
    ?>
    <?php
    }
    else
    {
        echo "<h1 class=\"h1TutoCenter\">Vous devez être connecté pour accéder à cette page.</h1>";
        echo "<div class=\"homeTuto\"><a href=\"../../index.php\" class=\"button-link\"><img src=\"../../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
    }
    ?>
</form>
</body>
</html>