<?php
include_once "Tutorial.php";

if (!isset($_SESSION)) {
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
    <h1>Forum - Modding Minecraft : Profile de <?php echo $_SESSION['username']; ?></h1>
    <form>
        <label>
            <p>Nom d'utilisateur : <?php echo $_SESSION['username']; ?></p>
        </label>
        <label>
            <p>Adresse e-mail : <?php echo $_SESSION['user_mail']; ?></p>
        </label>
        <label>
            <p>Telephone : <?php echo $_SESSION['user_phone']; ?></p>
        </label>
        <label>
            <a style="color: lavender; background-color: blue;" href="UpdateUserData.php">Modifier les informations</a>
        </label>
        <label>
            <a style="color: lavender; background-color: red;" href="DeleteUserData.php">Supprimer le compte</a>
        </label>
    </form>
</body>
</html>