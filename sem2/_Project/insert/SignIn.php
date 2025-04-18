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
    <title>Modding Minecraft - Inscription</title>
    <link rel="icon" href="../textures/logo_minecraft.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <link rel="stylesheet" type="text/css" href="../css/title.css">
</head>
<body>
    <h1 class="h1Tuto">Modding Minecraft - Inscription</h1>
    <?php echo "<div class=\"homeTuto\"><a href=\"../index.php\" class=\"button-link\"><img src=\"../textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>"; ?> 
    <?php
    if(isset($_GET["action"]) == "inscription")
    {
        echo "<a href=\"../user/LogIn.php\"><button type=\"button\">Se connecter</button></a>";
    }
    else {
    ?>
<form action="SignIn.php?action=inscription" method="POST">
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
    <button type="submit">Créer un compte</button>
</form>
    <?php
    } ?>

<p class="pCopyright"><?php
    include_once "../registries/RegistryEntry.php";
    include_once "../registries/User.php";

    if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])  && isset($_POST["telephone"])) {

        if ($_POST["username"] != "" && $_POST["email"] != "" && $_POST["password"] != "" && $_POST["telephone"] != "") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password']; // Attention : à hacher avant stockage en BDD !
            $telephone = $_POST['telephone'];

            if(RegistryEntry::isUniqueUser($username, $email))
            {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $user = new User($username, $hashedPassword, $email, $telephone);
                RegistryEntry::buildUserToBDD($user);
                echo "✅ Utilisateur ajouté avec succès !";
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