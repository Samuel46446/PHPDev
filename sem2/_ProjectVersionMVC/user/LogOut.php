<?php
if (!isset($_SESSION))
{
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' )
{
    session_unset(); // Libère toutes les variables de session
    session_destroy(); // Détruit la session
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modding Minecraft - Déconnection</title>
    <link rel="icon" href="../textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <link rel="stylesheet" type="text/css" href="../css/title.css">
</head>
<body>
<h1 class="h1TutoCenter">Forum - Modding Minecraft Se déconnecter</h1>

<?php
if(isset($_GET['disconnect']))
{
    echo "<p class=\"pCopyright\">Vous êtes déconnecté !</p>";
    echo "<div class=\"home\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
}
else
{
    echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
    ?>
    <form action="LogOut.php?disconnect=true" method="POST">
        <button type="submit" name="out">Se déconnecter</button>
    </form>

<?php
}?>
</body>
</html>