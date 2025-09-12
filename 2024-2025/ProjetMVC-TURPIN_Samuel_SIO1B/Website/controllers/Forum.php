<?php

use sem2\_ProjectVersionMVC\models\AttributeFetcher;
use sem2\_ProjectVersionMVC\models\RegistryEntry;

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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modding Minecraft - Forum</title>
    <link rel="icon" href="../textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <link rel="stylesheet" type="text/css" href="../css/title.css">
</head>
    <body>
        <h1 class="h1Tuto">Modding Minecraft - Forum</h1>
        <?php echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>"; ?>
        <table>
            <thead>
                <tr>
                    <th>Sujet</th>
                    <th>Description</th>
                    <th>ModLoader</th>
                    <th>Version</th>
                    <th>Auteur</th>
                    <th>
                        <div class="ForumButton">
                            <a title="Lien pour créer un post" href="../database/insert/CreatePost.php"> Créer un post 📩 </a>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php
                include_once "../models/RegistryEntry.php";
                include_once "../models/AttributeFetcher.php";

                foreach (RegistryEntry::getPosts() as $post) {
                    echo "<tr id=\"post\">";
                    echo "<td><a href='Posts.php?pno=" . $post['pno'] . "'>". htmlspecialchars($post['title']) ."</a></td>";
                    echo "<td>" . htmlspecialchars($post['description']) . "</td>";
                    echo "<td>" . AttributeFetcher::getLoaderById($post['lno']) . "</td>";
                    echo "<td>" . $post['version'] . "</td>";
                    echo "<td>". AttributeFetcher::getUsernameById($post['uno']) ."</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>

    </body>
</html>