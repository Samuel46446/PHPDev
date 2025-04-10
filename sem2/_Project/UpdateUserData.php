<?php
include_once "Tutorial.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["username"]) && !empty($_POST["password"]) &&
    !empty($_POST["email"]) && !empty($_POST["phone"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $_SESSION['sendingUserChanges'] = true;

        $user = new User($username, $email, $password, $phone);

        $id = AttributeFetcher::getUserIdByName($_SESSION['user_id']);
        SwitchRegistry::updateUserToBDD($id, $user);
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
<h1>Forum - Modding Minecraft : Update Tutorial</h1>

<form action="UpdateUserData.php" method="POST">
    <?php
    if (isset($_SESSION['sendingUserChanges'])) {
        if ($_SESSION['sendingUserChanges']) {
            echo "<p>✅ Vous avez modifié votre profil.</p>";
            echo "<div class=\"home\"><a href=\"index.php\" class=\"button-link\"><img src=\"textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"UpdateUserData.php\" class=\"button-link\"><img src=\"textures/components.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
        } else if ($_GET['sendingUserChanges'] === false) {
            echo "<p>❌ Le profil n'a pas pu être modifié, veuillez réessayer.</p>";
            echo "<a href=\"UpdateUserData.php\">Réessayer</a>";
        }
    } else {
        ?>
        <label>
            <p>Nom d'utilisateur : <?php echo $_SESSION['username']; ?></p>
        </label>
        <label>
            <input type="text" name="username" placeholder="Nouveau Nom d'utilisateur" required>
        </label>
        <label>
            <input type="password" name="password" placeholder="Nouveau mot de passe" required>
        </label>
        <label>
            <input type="email" name="email" placeholder="Nouvelle email" required>
        </label>
        <label>
            <input type="text" name="phone" placeholder="Nouveau numéro de téléphone" required>
        </label>
        <button type="submit">Modifier le profil</button>
        <?php
    }
    ?>
</form>
</body>
</html>