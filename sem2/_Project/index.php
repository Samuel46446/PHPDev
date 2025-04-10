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
      <title>Minecraft Modding Helper</title>
      <link rel="icon" href="textures/logo_minecraft.png" type="image/png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="css/title.css">
    </head>
    <body>
        <header>
            <h1 class="titleIndex">Minecraft Modding Helper</h1>
            <h3 class="titleIndex">Le site qui vous aide à créer vos mods Minecraft !</h3>
            <div class="selectButton">
                <a href="tutorial_example_block_fabric.php?tuto=Bloc&modloader=forge"> Tutoriels ✏️ </a>
            </div>
        </header>
        <form>
            <div class="logButtons">
                <a href="SignIn.php">S'inscrire <img src="textures/signin.png" alt="" width=25px height=25px> </a>
                <a href="LogIn.php">Se connecter <img src="textures/login.png" alt="" width=25px height=25px> </a>
                <a href="LogOut.php">Se déconnecter <img src="textures/logout.png" alt="" width=25px height=25px> </a>
            </div><br>
            <div class="ForumButton">
                <a href="Forum.php"> Forum 👥 </a>
            </div>
        </form>

        <form>
            <div class="createButton">
                <a href="CreateTutorial.php"> Ajouter un Tutoriel ⭐ </a>
            </div>
            <div class="createButton">
                <a href="CreateComponent.php"> Ajouter un Composant 📦 </a>
            </div>
        </form>

        <form>
            <div class="modifyButton">
                <a href="UpdateTutorial.php"> Modifier un Tutoriel 📝 </a>
            </div>
            <div class="modifyButton">
                <a href="UpdateComponent.php"> Modifier un Composant 📂 </a>
            </div>
        </form>

        <form>
            <div class="deleteButton">
                <a href="DeleteTutorial.php"> Supprimer un Tutoriel 🗑️ </a>
            </div>
            <div class="deleteButton">
                <a href="DeleteComponent.php"> Supprimer un Composant 🗑️ </a>
            </div>
        </form>
        <div class="content" id="content"></div>
        <table>
            <thead>
                <tr>
                    <?php
                    if (isset($_SESSION['user_id'], $_SESSION['username']))
                    {
                        echo '<div class=\"user_icon\"><a href=\"UserDataProfile.php\"><img src=\"textures/user_icon.png\" alt=\"Lien vers le profil de l\'utilisateur\" width=100 height=100></a></div>';
                    }
                    ?>
                </tr>
                <tr>
                </tr>
                <tr>
                </tr>
                <tr>
                </tr>
                <tr>
                </tr>
                <tr>
                </tr>
                <tr>
                </tr>
                <tr>
                </tr>
                <tr>
                </tr>
            </thead>
            <tbody>
                <tr>
                </tr>
                <tr>
                </tr>
                <tr>
                </tr>
            </tbody>
        </table>
    </body>
</html>