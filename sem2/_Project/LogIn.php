<?php
include_once "Main.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userFound = false;

        foreach (Main::getAllUsers() as $user) {
            if ($user['name'] === $username && $user['password'] === $password) {
                // Utilisateur authentifié avec succès
                $_SESSION['user_id'] = $user['uno'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['isCorrectLogged'] = true;

                $userFound = true;
                break;
            }
        }

        if ($userFound) {
            header("Location: LogIn.php?isLogged=true");
            exit();
        } else {
            $_SESSION['isCorrectLogged'] = false;
            header("Location: LogIn.php?isLogged=false");
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Modding Minecraft</title>
    <link rel="icon" href="textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <style>
        h1 {
            color: #5CEB95;
            margin-left: 20px;
        }

        body {
            background-color: rgb(17, 17, 17);
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
        }

        p {
            color: #F525E3;
        }

        .home {
            margin-top: 20px;
        }

        input, button {
            padding: 10px;
            margin-top: 10px;
            display: block;
        }

        .home{
            width: 50px;
            height: 50px;
            cursor: pointer;
            background-color: #bd31d3;
        }

    </style>
</head>
<body>
<h1>Forum - Modding Minecraft : Connexion</h1>

<form action="LogIn.php" method="POST">
    <?php
    if (isset($_GET['isLogged'], $_SESSION['isCorrectLogged'])) {
        if ($_GET['isLogged'] === 'true' && $_SESSION['isCorrectLogged']) {
            echo "<p>✅ Vous êtes connecté, cliquez sur Home pour retourner à l'accueil.</p>";
            echo "<div class=\"home\"><a href=\"index.php\" class=\"button-link\"><img src=\"textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
        } else if ($_GET['isLogged'] === 'false') {
            echo "<p>❌ L'utilisateur ou le mot de passe est incorrect ou inexistant, veuillez réessayer.</p>";
            echo "<a href=\"LogIn.php\">Réessayer</a>";
        }
    } else {
        ?>
        <label>
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        </label>
        <label>
            <input type="password" name="password" placeholder="Mot de passe" required>
        </label>
        <button type="submit">Se connecter</button>
        <?php
    }
    ?>
</form>
</body>
</html>