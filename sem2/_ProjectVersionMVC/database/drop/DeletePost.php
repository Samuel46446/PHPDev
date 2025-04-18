<?php
include_once "../../models/DroppingRegistry.php";
include_once "../../models/AttributeFetcher.php";
include_once "../../models/RegistryEntry.php";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['deleter'])) {
    DroppingRegistry::dropPost(intval($_GET['pno']));
    $_SESSION['sendingPostDrop'] = true;
    header("Location: DeletePost.php?pno=" . $_GET['pno']);
    exit();
}
else if(!isset($_POST['deleter']) && !isset($_SESSION['userActual']))
{
    $pno = 0;

    if (isset($_GET['pno'])) {
        $pno = intval($_GET['pno']); // Sécurise l'entrée
    }

    $post = AttributeFetcher::getPostById($pno);

    if (!$post) {
        die("❌ Aucun post trouvé avec l'ID spécifié.");
    }
    else {
        $_SESSION['userActual'] = RegistryEntry::getUserById($post['uno']);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modding Minecraft - Suppression d'un post</title>
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
if (($_SESSION['user_id'] === 1 && $_SESSION['username'] === "Admin") || ($_SESSION['username'] === $_SESSION['userActual']->getUsername()))
{
?>
<h1 class="h1Tuto">Modding Minecraft : Delete Post</h1>
<form action="DeletePost.php?pno=<?php echo $_GET['pno']; ?>" method="POST">
    <?php
    if (isset($_SESSION['sendingPostDrop'])) {
        if ($_SESSION['sendingPostDrop']) {
            echo "<p class=\"pCopyright\">✅ Vous avez supprimer le post.</p>";
            echo "<div class=\"home\"><a href=\"../../index.php\" class=\"button-link\"><img src=\"../../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"../../controllers/Forum.php\" class=\"button-link\"><img src=\"../../textures/message.png\" alt=\"Lien vers le Forum\" width=\"50\" height=\"50\"></a></div>";
            unset($_SESSION['sendingPostDrop']);
            unset($_SESSION['userActual']);
        } else if ($_SESSION['sendingPostDrop'] === false) {
            echo "<p>❌ Le post n'a pas pu être supprimé, veuillez réessayer.</p>";
            echo "<a href=\"DeletePost.php?pno=".$_GET['pno']."\" title=\"Lien pour réessayer\">Réessayer</a>";
        }
    } else {
        ?>
        <button type="submit" name="deleter">Supprimer le post</button>
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