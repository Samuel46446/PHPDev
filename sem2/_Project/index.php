<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION['isCorrectLogged'] = false;
}

if (isset($_SESSION['sendingTutorial'])) {
    unset($_SESSION['sendingTutorial']);
}

if (isset($_SESSION['sendingComponent'])) {
    unset($_SESSION['sendingComponent']);
}

var_dump($_SESSION); // 🔍 Affichage explicite avant tout traitement.

if (isset($_SESSION['user_id'], $_SESSION['username'])) {
    echo htmlspecialchars($_SESSION['user_id']) . " : " . htmlspecialchars($_SESSION['username']) . " est connecté.";
} else {
    echo "Aucun utilisateur connecté.";
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
      <title> <?php include_once "Main.php"; echo Main::$NAME; ?> </title>
      <link rel="icon" href="textures/logo_minecraft.png" type="image/png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="css/title.css">
    </head>
    <body>
        <div class="content" id="content"></div>

        <table>
            <thead>
                <tr>
                    <a class="button-link" href="java/quest1.html"> FORGE <img src="textures/logo_java.png" alt="" width=25px height=25px> </a>
                </tr>
                <tr>
                    <a class="button-link" href="tutorial_example_block_fabric.php?modloader=forge&tuto=Bloc"> FABRIC <img src="textures/logo_cs.png" alt="" width=25px height=25px> </a>
                </tr>
                <tr>
                    <a class="button-link" href="cpp/quest1.html"> NEOFORGE <img src="textures/logo_cpp.png" alt="" width=25px height=25px> </a>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <a class="button-link" href="SignIn.php"> S'inscrire <img src="textures/logo_cpp.png" alt="" width=25px height=25px> </a>
                </tr>
                <tr>
                    <a class="button-link" href="LogIn.php"> Se connecter <img src="textures/logo_cpp.png" alt="" width=25px height=25px> </a>
                </tr>
                <tr>
                    <a class="button-link" href="LogOut.php"> Se déconnecter <img src="textures/logo_cpp.png" alt="" width=25px height=25px> </a>
                </tr>
                <tr>
                    <?php

                    if (isset($_SESSION['user_id'], $_SESSION['username']))
                    {
                        echo "<div class=\"user_icon\"></div><img src=\"textures/user_icon.png\" alt=\"\" width=100 height=100></div>";
                    }

                    ?>
                </tr>
            </tbody>
        </table>
    </body>
</html>