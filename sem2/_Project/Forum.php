<?php
if (!isset($_SESSION))
{
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Modding Minecraft</title>
    <link rel="icon" href="textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <style>
        h1{
            color: #5CEB95;
            margin-left: 20px;
            align-self: center;

        }
        h2{
            color: #1FC946;
            margin-left: 20px;
        }
        p{
            color: #F525E3;
            margin-left: 40px;
        }
        body {
            background-color: rgb(17, 17, 17);
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }
        pre {
            background-color: rgb(17, 17, 17);
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
            display: inline-block; /* Ajuste la largeur au contenu */
            max-width: 100%; /* Empêche le dépassement */
            border: 1px solid rgb(17, 17, 17);
            white-space: pre-wrap; /* Permet les retours à la ligne si besoin */
        }
        .language-java {
            border-radius: 10px;
        }
        .language-json {
            border-radius: 10px;
        }
        table {
            background-color: #0000;
            align-items: center;
        }
        th{
            border: 1px solid #ffffff;
            color: #5CEB95;
            align-items: center;
            padding: 10px;
        }
        tr{
            color: #F525E3;
            align-items: center;
            max-width: 100%;
        }
        td{
            border: 1px solid #ffffff;
            padding: 10px;
        }

        #post{
            background-color: #0000;
            color: #ffffff;
        }
    </style>
</head>
    <body>
        <h1>Forum - Modding Minecraft</h1>

        <table>
            <thead>
                <tr>
                    <th>Sujet</th>
                    <th>Description</th>
                    <th>ModLoader</th>
                    <th>Version</th>
                    <th>Auteur</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include_once "Main.php";

                foreach (Main::getAllPosts() as $post) {
                    echo "<tr id=\"post\">";
                    echo "<td><a href='Post.php?pno=" . $post['pno'] . "'>". htmlspecialchars($post['title']) ."</a></td>";
                    echo "<td>" . htmlspecialchars($post['description']) . "</td>";
                    echo "<td>" . Main::getLoaderById($post['lno']) . "</td>";
                    echo "<td>" . $post['version'] . "</td>";
                    echo "<td>". Main::getUserById($post['uno']) ."</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>

    </body>
</html>