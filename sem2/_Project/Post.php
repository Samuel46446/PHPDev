<!DOCTYPE html>
<html lang="fr">
<head>
    <?php

    include_once "Main.php";

    $pno = 0;

    if (isset($_GET['pno'])) {
        $pno = intval($_GET['pno']); // Sécurise l'entrée
    }

    $post = Main::getPostById($pno);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Modding Minecraft</title>
    <?php echo "<link rel=\"icon\" href=\"textures/" . Main::getLogoLoaderById($post['lno']) . ".png\" type=\"image/x-icon\">"; ?>
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
        <td><?php echo $post['title']; ?></td>
        <td><?php echo Main::getLoaderById($post['lno']); ?></td>
        <td><?php echo $post['version']; ?></td>
        <td><?php echo htmlspecialchars(Main::getUserById($post['uno'])); ?></td>
        <?php
        if(Main::getUserById($post['uno']) == $_SESSION['user_id'])
        {
            echo "<td>
            <form action=\"". Main::deletePostById($_GET['pno']) . "\" method=\"POST\" onsubmit=\"return confirm('Voulez-vous vraiment supprimer ce post ?');\">
                <input type=\"hidden\" name=\"pno\" value=\"". $_GET['pno'] . "\"> <!-- ID du post à supprimer -->
                <button type=\"submit\" class=\"btn-delete\">🗑️ Supprimer</button>
            </form>
        </td>";
        }
        ?>
        <td>
            <form action="rep_post.php" method="POST">

                <label for="message">Message :</label>
                <textarea id="message" name="message" required></textarea>

                <input type="hidden" name="uno" value="1"> <!-- ID de l'utilisateur connecté -->
                <input type="hidden" name="lno" value="2"> <!-- ID du loader (exemple) -->

                <button type="submit">Créer le post</button>
            </form>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr id="post">
        <td><?php echo htmlspecialchars(Main::getUserById($post['uno'])); ?></td>
        <td><?php echo htmlspecialchars($post['description']); ?></td>
    </tr>
    <?php
        foreach (Main::getReponseByIdPost($pno) as $rep) {
            echo "<tr id=\"post\">";
            echo "<td> " . htmlspecialchars(Main::getUserById($rep['uno'])) . "</td>";
            echo "<td>" . htmlspecialchars($rep['msg']) . "</td>";
            echo "</tr>";
        }
    ?>
    </tbody>
</table>

</body>
</html>