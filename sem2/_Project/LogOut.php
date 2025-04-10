<?php
session_start();
include_once "Tutorial.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $userFound = false;

        foreach (RegistryEntry::getUsers() as $user) {
            if ($user['name'] === $username && $user['password'] === $password) {
                $_SESSION['user_id'] = $user['uno'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_phone'] = $user['phone'];

                $userFound = true;
                break;
            }
        }

        if ($userFound) {
            var_dump($_SESSION); // 🔍 Afficher explicitement la session avant la redirection
            exit; // empêcher temporairement la redirection automatique
            // header("Location: index.php?login=success");
            // exit();
        } else {
            echo "Utilisateur introuvable ou mdp incorrect";
        }
    } else {
        echo "Veuillez remplir les champs";
    }
}?>
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
<h1>Forum - Modding Minecraft Se déconnecter</h1>
<form action="index.php" method="POST">
    <button type="submit" onclick=<?php session_destroy(); ?>>Se déconnecter</button>
</form>
</body>
</html>