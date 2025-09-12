<?php

if (!isset($_SESSION)) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modding Minecraft - Profil</title>
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
    { ?>
    <h1 class="h1TutoCenter">Modding Minecraft : Profile de <?php echo $_SESSION['username']; ?></h1>
    <?php echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>"; ?>
    <form>
        <label>
            <p class="pTuto">Nom d'utilisateur : <?php echo $_SESSION['username']; ?></p>
        </label>
        <label>
            <p class="pTuto">Adresse e-mail : <?php echo $_SESSION['user_mail']; ?></p>
        </label>
        <label>
            <p class="pTuto">Telephone : <?php echo $_SESSION['user_phone']; ?></p>
        </label>
        <label>
            <a class="modifyButton" href="../update/UpdateUserData.php">Modifier les informations</a>
        </label>
        <label>
            <a class="deleteButton" href="../database/drop/DeleteUserData.php">Supprimer le compte</a>
        </label>
    </form>
    <?php
    }
    else
    {
        echo "<h1 class=\"h1TutoCenter\">Vous devez être connecté pour accéder à cette page.</h1>";
        echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
    }
    ?>
</body>
</html>