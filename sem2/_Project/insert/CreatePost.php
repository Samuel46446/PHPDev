<?php
include_once "../registries/Post.php";
include_once "../registries/RegistryEntry.php";
include_once "../registries/AttributeFetcher.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION["user_id"]) && !empty($_POST["modLoader"] &&
    !empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["version"]))) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $version = $_POST['version'];
        $uno = $_SESSION["user_id"];
        $modLoader = $_POST['modLoader'];
        $idModLoader = AttributeFetcher::getLoaderIdByName($modLoader);

        $_SESSION['sendingPost'] = true;

        $post = new Post($title, $description, $version, $uno, $idModLoader);

        RegistryEntry::buildPostToBDD($post);
    }
    else
    {
        $_SESSION['sendingPost'] = false;
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
?>
<h1 class="h1Tuto">Modding Minecraft - Forum : Créer un post</h1>
<form action="CreatePost.php" method="POST">
    <?php
    if (isset($_SESSION['sendingPost'])) {
        if ($_SESSION['sendingPost']) {
            echo "<p class=\"pCopyright\">✅ Vous avez créé le post.</p>";
            echo "<div class=\"home\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"../Forum.php\" class=\"button-link\"><img src=\"../textures/message.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
        } else if ($_GET['sendingPost'] === false) {
            echo "<p class=\"pCopyright\">❌ Le post n'a pas pu être créé, veuillez réessayer.</p>";
            echo "<a href=\"CreatePost.php\">Réessayer</a>";
        }
    } else {
        ?>
        <?php echo "<div class=\"homeTuto\"><a href=\"Forum.php\" class=\"button-link\"><img src=\"textures/message.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>"; ?>
        <?php echo "<div class=\"homeTuto\"><a href=\"index.php\" class=\"button-link\"><img src=\"textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>"; ?>
        <label>
            <textarea class="buttonDisco" name="title" placeholder="Titre du post" required></textarea>
        </label>
        <label>
            <textarea class="buttonDisco" name="description" placeholder="Description du post" required></textarea>
        </label>
        <label>
            <input class="buttonDisco" type="text" name="version" placeholder="Version Minecraft du post" required>
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
        <button class="buttonDisco" type="submit">Créer le post</button>
        <?php
    }
    ?>
</form>
    <?php
}
else
{
    echo "<p class=\"pCopyright\">❌ Vous devez être connecté pour accéder à cette page.</p>";
}
?>
</body>
</html>