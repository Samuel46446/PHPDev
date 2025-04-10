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
<h1>Forum - Modding Minecraft Inscription</h1>

<?php

if(isset($_GET["action"]) == "inscription")
{
    echo "<a href=\"LogIn.php\"><button type=\"button\">Se connecter</button></a>";
}
?>

<form action="?action=inscription" method="POST">
    <label>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    </label>
    <label>
        <input type="email" name="email" placeholder="Email" required>
    </label>
    <label>
        <input type="password" name="password" placeholder="Mot de passe" required>
    </label>
    <label>
        <input type="text" name="telephone" placeholder="Téléphone" required>
    </label>
    <button type="submit" onclick="">Créer un compte</button>
</form>

<p><?php
    include_once "Tutorial.php";

    if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])  && isset($_POST["telephone"])) {

        if ($_POST["username"] != "" && $_POST["email"] != "" && $_POST["password"] != "" && $_POST["telephone"] != "") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password']; // Attention : à hacher avant stockage en BDD !
            $telephone = $_POST['telephone'];

            if(RegistryEntry::isUniqueUser($username, $email))
            {
                $user = new User($username, $email, $password, $telephone);
                echo RegistryEntry::buildUserToBDD($user);
            }
            else
            {
                echo "❌ Le Nom d'utilisateur ou l'Email est déjà utiliser !";
            }
        }
        else
        {
            echo "Veuillez remplir tous les champs !";
        }
    }
    else
    {
        echo "Veuillez remplir tous les champs !";
    }

?></p>

</body>
</html>