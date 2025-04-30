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
        <title>Minecraft Modding - Accueil</title>
        <link rel="icon" href="textures/logo_minecraft.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/title.css">
    </head>
    <body>
        <header>
            <h1 class="titleIndex">Minecraft Modding</h1>
            <h3 class="titleIndex">Le site qui vous aide à créer vos mods Minecraft !</h3>
            <p class="titleIndex">Vous pouvez consulter les tutoriels sans être connecté, pour accéder au forum il faudra s'inscrire ou se connnecter.</p>
            <div aria-label="Lien vers la page des Tutoriels">
                <a class="selectButton" href="controllers/TemplateTutorial.php?tuto=Bloc&modloader=forge"> Page vers les Tutoriels <span aria-hidden="true">✏️</span> </a>
            </div>
        </header>
        <form>
            <div>
                <?php

                if (empty($_SESSION['user_id']) && empty($_SESSION['username']))
                {
                    ?>
                <a class="logButtons" title="Lien vers la page d'Inscription" href="database/insert/SignIn.php">S'inscrire <img src="textures/signin.png" aria-hidden="true" width=25px height=25px alt=""> </a>
                <a class="logButtons" title="Lien vers la page de connexion" href="user/LogIn.php">Se connecter <img src="textures/login.png" aria-hidden="true" width=25px height=25px alt=""> </a>
                    <?php
                }
                else
                {
                    ?>
                    <a class="logButtons" title="Lien vers la page de déconnexion" href="user/LogOut.php">Se déconnecter <img src="textures/logout.png" aria-hidden="true" width=25px height=25px alt=""> </a>
                    <?php
                }
                ?>
            </div>
            <?php
            if (isset($_SESSION['user_id'], $_SESSION['username']))
            {
            ?>
            <div>
                <a class="ForumButton" title="Lien vers le Forum de Modding Minecraft" href="controllers/Forum.php"> Forum <span aria-hidden="true">👥</span> </a>
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
                <a class="createButton" title="Lien pour ajouter un tutoriel" href="database/insert/CreateTutorial.php"> Ajouter un Tutoriel <span aria-hidden="true">⭐</span> </a>
            </div>
            <div>
                <a class="createButton" title="Lien pour ajouter un composant" href="database/insert/CreateComponent.php"> Ajouter un Composant <span aria-hidden="true">📦</span> </a>
            </div>
        </form>

        <form>
            <div>
                <a class="modifyButton" title="Lien pour modifier un tutoriel" href="update/UpdateTutorial.php"> Modifier un Tutoriel <span aria-hidden="true">📝</span> </a>
            </div>
            <div>
                <a class="modifyButton" title="Lien pour modifier un composant" href="update/UpdateComponent.php"> Modifier un Composant <span aria-hidden="true">📂</span> </a>
            </div>
        </form>

        <form>
            <div>
                <a class="deleteButton" title="Lien pour supprimer un tutoriel" href="database/drop/DeleteTutorial.php"> Supprimer un Tutoriel <span aria-hidden="true">🗑️</span> </a>
            </div>
            <div>
                <a class="deleteButton" title="Lien pour supprimer un composant" href="database/drop/DeleteComponent.php"> Supprimer un Composant <span aria-hidden="true">🗑️</span> </a>
            </div>
        </form>
        <?php } } ?>
        <div class="profilUser">
            <?php
            if (isset($_SESSION['user_id'], $_SESSION['username']))
            {
                echo "<div class=\"user_icon\"><a href=\"user/UserDataProfile.php\"><img src=\"textures/user_icon.png\" alt=\"Lien vers le profil de l'utilisateur\" width=100 height=100></a></div>";
                echo "<h3 class=\"pCopyright\">" . htmlspecialchars($_SESSION['username']) . " est connecté.";
            } else {
                echo "<h3 class=\"pCopyright\">Aucun utilisateur connecté.</h3>";
            }

            ?>
        </div>
    </body>
</html>