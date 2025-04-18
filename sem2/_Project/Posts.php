<?php
include_once "registries/Reponse.php";
include_once "registries/AttributeFetcher.php";
include_once "registries/RegistryEntry.php";
include_once "registries/DroppingRegistry.php";

if (!isset($_SESSION))
{
    session_start();
}

if (isset($_SESSION['sendingPostChanges'])) {
    unset($_SESSION['sendingPostChanges']);
}

if (isset($_SESSION['sendingPost'])) {
    unset($_SESSION['sendingPost']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply']))
{
    if (!empty($_POST["message"]))
    {
        $text = $_POST["message"];
        $uno = $_SESSION['user_id'];
        $pno = $_GET['pno'];

        $reponse = new Reponse($text, $pno, $uno);
        RegistryEntry::buildReponseToBDD($reponse);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php

    $pno = 0;

    if (isset($_GET['pno'])) {
        $pno = intval($_GET['pno']); // Sécurise l'entrée
    }

    $post = AttributeFetcher::getPostById($pno);
    $uno = intval($post['uno']);

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Modding Minecraft</title>
    <?php echo "<link rel=\"icon\" href=\"textures/" . AttributeFetcher::getLogoLoaderById($post['lno']) . ".png\" type=\"image/x-icon\">"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <link rel="stylesheet" type="text/css" href="css/title.css">
</head>
<body>
<h1 class="h1Tuto">Forum - Modding Minecraft</h1>
<?php echo "<div class=\"homeTuto\"><a href=\"Forum.php\" class=\"button-link\"><img src=\"textures/message.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>"; ?>
<?php echo "<div class=\"homeTuto\"><a href=\"index.php\" class=\"button-link\"><img src=\"textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>"; ?>
<table>
    <thead>
    <tr>
        <td><?php echo $post['title']; ?></td>
        <td><?php echo AttributeFetcher::getLoaderById($post['lno']); ?></td>
        <td><?php echo $post['version']; ?></td>
        <td><?php echo htmlspecialchars(RegistryEntry::getUserById($uno)->getUsername()); ?></td>
        <?php
        if(RegistryEntry::getUserById($uno)->getUsername() === $_SESSION['username'])
        { ?>
            <td>
                <form action="update/UpdatePost.php?pno=<?php echo $_GET['pno']; ?>" method="POST">
                    <button type="submit" class="modifyButton">✏️ Modifier</button>
                </form>
            </td>
            <td>
                <form action="drop/DeletePost.php?pno=<?php echo $_GET['pno']; ?>" method="POST">
                    <button type="submit" class="deleteButton">🗑️ Supprimer</button>
                </form>
            </td>
        <?php
        } ?>
        <td>
            <form action="Posts.php?pno=<?php echo $_GET['pno']; ?>" method="POST">
                <label for="message">Message :</label>
                <textarea id="message" name="message" required></textarea>
                <button type="submit" name="reply">Répondre</button>
            </form>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr id="post">
        <td><?php echo htmlspecialchars(RegistryEntry::getUserById($post['uno'])->getUsername()); ?></td>
        <td><?php echo htmlspecialchars($post['description']); ?></td>
    </tr>
    <?php
        foreach (AttributeFetcher::getResponseByIdPost($pno) as $rep) {
            echo "<tr id=\"post\">";
            echo "<td> " . htmlspecialchars(RegistryEntry::getUserById($rep['uno'])->getUsername()) . "</td>";
            echo "<td>" . htmlspecialchars($rep['msg']) . "</td>";


            if(RegistryEntry::getUserById($rep['uno'])->getUsername() === $_SESSION['username'])
            {
                echo "<td>";
                echo "<form action=\"update/UpdateReponse.php?pno=".$rep['pno']."&rno=".$rep['rno']."\" method=\"POST\">";
                echo "<button class=\"modifyButton\" type=\"submit\" name=\"modifyMsg\">Modifier le message</button>";
                echo "</form>";
                echo "</td>";

                echo "<td>";
                echo "<form action=\"drop/DeleteReponse.php?pno=".$rep['pno']."&rno=".$rep['rno']."\" method=\"POST\">";
                echo "<button class=\"deleteButton\" type=\"submit\" name=\"deleteMsg\">Supprimer le message</button>";
                echo "</form>";
                echo "</td>";
            }
            echo "</tr>";
        }
    ?>
    </tbody>
</table>

</body>
</html>