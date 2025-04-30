<?php
include_once "../models/RegistryEntry.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userFound = false;

        foreach (RegistryEntry::getUsers() as $user) {
            if ($user['name'] === $username && password_verify($password, $user['password'])) {
                // Utilisateur authentifié avec succès
                $_SESSION['user_id'] = $user['uno'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['user_mail'] = $user['email'];
                $_SESSION['user_phone'] = $user['phone'];
                unset($_SESSION['isCorrectLogged']);
                $_SESSION['isCorrectLogged'] = true;

                $userFound = true;
                break;
            }
        }

        if ($userFound) {
            header("Location: LogIn.php?isLogged=true");
            $_SESSION['isCorrectLogged'] = true;
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
    <title>Modding Minecraft - Se connecter</title>
    <link rel="icon" href="../textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <link rel="stylesheet" type="text/css" href="../css/title.css">
</head>
<body>
<h1 class="h1TutoCenter">Modding Minecraft : Connexion</h1>
    <?php
    if ($_GET['isLogged'] === 'false')
    {
        echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
    }
    else if (!$_SESSION['isCorrectLogged']){
        echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
    }
    ?>
<form action="LogIn.php" method="POST">
    <?php
    if (isset($_GET['isLogged'], $_SESSION['isCorrectLogged'])) {
        if ($_GET['isLogged'] === 'true' && $_SESSION['isCorrectLogged']) {
            echo "<p class=\"pCopyrightCenter\">✅ Vous êtes connecté, cliquez sur Home pour retourner à l'accueil.</p>";
            echo "<div class=\"home\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Lien vers le menu d'accueil\" width=\"50\" height=\"50\"></a></div>";
        } else if ($_GET['isLogged'] === 'false') {
            echo "<p class=\"pCopyrightCenter\">❌ L'utilisateur ou le mot de passe est incorrect ou inexistant, veuillez réessayer.</p>";
            echo "<a href=\"LogIn.php\" title=\"Lien pour réessayer de se connecter\">Réessayer</a>";
        }
    } else {
        ?>
        <label>
            <input class="buttonDisco" type="text" name="username" placeholder="Nom d'utilisateur" required>
        </label>
        <label>
            <input class="buttonDisco" type="password" name="password" placeholder="Mot de passe" required>
        </label>
        <button class="buttonDisco" type="submit">Se connecter</button>
        <?php
    }
    ?>
</form>
</body>
</html>