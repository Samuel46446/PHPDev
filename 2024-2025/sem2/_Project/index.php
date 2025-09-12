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

if (isset($_SESSION['sendingUserDrop'])) {
    unset($_SESSION['sendingUserDrop']);
}

if(isset($_SESSION['sendingPost'])) {
    unset($_SESSION['sendingPost']);
}

if (isset($_SESSION['sendingPostDrop'])) {
    unset($_SESSION['sendingPostDrop']);
}

if (isset($_SESSION['userActual'])) {
    unset($_SESSION['userActual']);
}

if (isset($_SESSION['sendingPostChanges'])) {
    unset($_SESSION['sendingPostChanges']);
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Minecraft Modding Helper</title>
        <link rel="icon" href="textures/logo_minecraft.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/title.css">
    </head>
    <body>
        <header>
            <h1 class="titleIndex">Minecraft Modding Helper</h1>
            <h3 class="titleIndex">Le site qui vous aide à créer vos mods Minecraft !</h3>
            <div>
                <a class="selectButton" href="TemplateTutorial.php?tuto=Bloc&modloader=forge"> Tutoriels ✏️ </a>
            </div>
        </header>
        <form>
            <div>
                <?php

                if (empty($_SESSION['user_id']) && empty($_SESSION['username']))
                {
                    ?>
                <a class="logButtons" href="insert/SignIn.php">S'inscrire <img src="textures/signin.png" alt="" width=25px height=25px> </a>
                <a class="logButtons" href="user/LogIn.php">Se connecter <img src="textures/login.png" alt="" width=25px height=25px> </a>
                    <?php
                }
                else
                {
                    ?>
                    <a class="logButtons" href="user/LogOut.php">Se déconnecter <img src="textures/logout.png" alt="" width=25px height=25px> </a>
                    <?php
                }
                ?>
            </div>
            <?php
            if (isset($_SESSION['user_id'], $_SESSION['username']))
            {
            ?>
            <div>
                <a class="ForumButton" href="Forum.php"> Forum 👥 </a>
            </div>
            <?php } ?>
        </form>

        <?php
        if (isset($_SESSION['user_id'], $_SESSION['username']))
        {
            if ($_SESSION['user_id'] === 1 && $_SESSION['username'] === "Admin")
            {
        ?>
        <form>
            <div>
                <a class="createButton" href="insert/CreateTutorial.php"> Ajouter un Tutoriel ⭐ </a>
            </div>
            <div>
                <a class="createButton" href="insert/CreateComponent.php"> Ajouter un Composant 📦 </a>
            </div>
        </form>

        <form>
            <div>
                <a class="modifyButton" href="update/UpdateTutorial.php"> Modifier un Tutoriel 📝 </a>
            </div>
            <div>
                <a class="modifyButton" href="update/UpdateComponent.php"> Modifier un Composant 📂 </a>
            </div>
        </form>

        <form>
            <div>
                <a class="deleteButton" href="drop/DeleteTutorial.php"> Supprimer un Tutoriel 🗑️ </a>
            </div>
            <div>
                <a class="deleteButton" href="drop/DeleteComponent.php"> Supprimer un Composant 🗑️ </a>
            </div>
        </form>
        <?php } } ?>
        <div class="profilUser">
            <?php
            if (isset($_SESSION['user_id'], $_SESSION['username']))
            {
                echo "<div class=\"user_icon\"><a href=\"user/UserDataProfile.php\"><img src=\"textures/user_icon.png\" alt=\"Lien vers le profil de l\'utilisateur\" width=100 height=100></a></div>";
                echo "<h3 class=\"pCopyright\">" . htmlspecialchars($_SESSION['username']) . " est connecté.";
            } else {
                echo "<h3 class=\"pCopyright\">Aucun utilisateur connecté.</h3>";
            }

            ?>
        </div>
    </body>
</html>