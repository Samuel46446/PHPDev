<?php

use sem2\_Project\registries\SwitchRegistry;
use sem2\_ProjectVersionMVC\models\AttributeFetcher;
use sem2\_ProjectVersionMVC\models\RegistryEntry;
use sem2\_ProjectVersionMVC\models\User;

include_once "../registries/User.php";
include_once "../registries/RegistryEntry.php";
include_once "../registries/AttributeFetcher.php";

if (!isset($_SESSION)) {
    session_start();
}
$id = AttributeFetcher::getUserIdByName($_SESSION['username']);
$actualUser = RegistryEntry::getUserById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["username"]) && !empty($_POST["password"]) &&
    !empty($_POST["email"]) && !empty($_POST["phone"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if(RegistryEntry::isUniqueUser($username, $email))
        {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $newUser = new User($username, $hashedPassword, $email, $phone);
            session_destroy();
            SwitchRegistry::updateUserToBDD($id, $newUser);
            $_SESSION['sendingUserChanges'] = true;
        }
        else
        {
            $_SESSION['sendingUserChanges'] = false;
        }
    }
    else
    {
        $_SESSION['sendingUserChanges'] = false;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Modding Minecraft</title>
    <link rel="icon" href="../textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <link rel="stylesheet" type="text/css" href="../css/title.css">
</head>
<body>
<?php
if (isset($_SESSION['user_id'], $_SESSION['username']))
{ ?>
<h1 class="h1Tuto">Modding Minecraft : Update User Profile</h1>

<form action="UpdateUserData.php" method="POST">
    <?php
    if (isset($_SESSION['sendingUserChanges'])) {
        if ($_SESSION['sendingUserChanges']) {
            echo "<p class=\"pCopyright\">✅ Vous avez modifié votre profil.</p>";
            echo "<div class=\"home\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"UpdateUserData.php\" class=\"button-link\"><img src=\"../textures/components.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
        } else if ($_GET['sendingUserChanges'] === false) {
            echo "<p class=\"pCopyright\">❌ Le profil n'a pas pu être modifié, veuillez réessayer.</p>";
            echo "<a href=\"UpdateUserData.php\">Réessayer</a>";
        }
    } else {
        ?>
        <label>
            <p class="pTuto">Nom d'utilisateur : <?php echo $_SESSION['username']; ?></p>
        </label>
        <label>
            <input class="buttonDisco" type="text" name="username" value="<?php echo $actualUser->getUsername(); ?>" placeholder="Nouveau Nom d'utilisateur" required>
        </label>
        <label>
            <input class="buttonDisco" type="password" name="password" placeholder="Nouveau mot de passe" required>
        </label>
        <label>
            <input class="buttonDisco" type="email" name="email" value="<?php echo $actualUser->getEmail(); ?>" placeholder="Nouvelle email" required>
        </label>
        <label>
            <input class="buttonDisco" type="text" name="phone" value="<?php echo $actualUser->getTelephone(); ?>" placeholder="Nouveau numéro de téléphone" required>
        </label>
        <button class="buttonDisco" type="submit">Modifier le profil</button>
        <?php
    }
    ?>
    <?php
    }
    else
    {
        echo "<h1 class=\"h1TutoCenter\">Vous devez être connecté pour accéder à cette page.</h1>";
        echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
    }
    ?>
</form>
</body>
</html>