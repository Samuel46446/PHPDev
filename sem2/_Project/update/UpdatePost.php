<?php
include_once "../registries/RegistryEntry.php";
include_once "../registries/AttributeFetcher.php";
include_once "../registries/SwitchRegistry.php";
include_once "../registries/Post.php";

if (!isset($_SESSION)) {
    session_start();
}
$id = AttributeFetcher::getUserIdByName($_SESSION['username']);
$actualUser = RegistryEntry::getUserById($id);
$actualPost = AttributeFetcher::getPostById(intval($_GET['pno']));

$_POST['modLoader'] = AttributeFetcher::getLoaderById($actualPost['lno']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modify'])) {
    if (!empty($_POST["modLoader"]) && !empty($_POST["title"]) &&
        !empty($_POST["description"]) && !empty($_POST["version"])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $version = $_POST['version'];
        $uno = $actualPost["uno"];
        $modLoader = $_POST['modLoader'];
        $idModLoader = AttributeFetcher::getLoaderIdByName($modLoader);

        $_SESSION['sendingPostChanges'] = true;

        $post = new Post($title, $description, $version, $uno, $idModLoader);

        SwitchRegistry::updatePostToBDD(intval($_GET['pno']), $post);
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
    <title>Forum Modding Minecraft - Update Post</title>
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
if (($_SESSION['user_id'] === 1 && $_SESSION['username'] === "Admin") || ($_SESSION['username'] === $actualUser->getUsername()))
{?>
<h1 class="h1Tuto">Modding Minecraft : Update Post</h1>

<form action="UpdatePost.php?pno=<?php echo $_GET['pno']; ?>" method="POST">
    <?php
    if (isset($_SESSION['sendingPostChanges'])) {
        if ($_SESSION['sendingPostChanges']) {
            echo "<p class=\"pCopyright\">✅ Vous avez modifié le post.</p>";
            echo "<div class=\"home\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"../Posts.php?pno=".$_GET['pno']."\" class=\"button-link\"><img src=\"../textures/components.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
        } else if ($_SESSION['sendingPostChanges'] === false) {
            echo "<p class=\"pCopyright\">❌ Le post n'a pas pu être modifié, veuillez réessayer.</p>";
            echo "<a href=\"UpdatePost.php?pno=".$_GET['pno']."\">Réessayer</a>";
        }
    } else {
        ?>
        <label>
            <textarea class="buttonDisco" name="title" placeholder="Nouveau Titre du Post" required><?php echo $actualPost['title']; ?></textarea>
        </label>
        <label>
            <textarea class="buttonDisco" name="description" placeholder="Nouvelle Description" required><?php echo $actualPost['description']; ?></textarea>
        </label>
        <label>
            <textarea class="buttonDisco" name="version" placeholder="Nouvelle version" required><?php echo $actualPost['version']; ?></textarea>
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
        <button class="buttonDisco" type="submit" name="modify">Modifier le post</button>
        <?php
    }
    }
    }
    else
    {
        echo "<h1 class=\"h1TutoCenter\">Vous devez être connecté pour accéder à cette page.</h1>";
        echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
    }
    ?>
</form>
</body>
</html>