<?php
include_once "Main.php";
include_once "Tutorial.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["component"])) {

        $_SESSION['sendingComponent'] = true;
        DroppingRegistry::dropComponent($_POST['component']);
    }
    else
    {
        $_SESSION['sendingComponent'] = false;
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
<h1>Forum - Modding Minecraft : Delete Component</h1>

<form action="DeleteComponent.php" method="POST">
    <?php
    if (isset($_SESSION['sendingComponent'])) {
        if ($_SESSION['sendingComponent']) {
            echo "<p>✅ Vous avez supprimer le composant.</p>";
            echo "<div class=\"home\"><a href=\"index.php\" class=\"button-link\"><img src=\"textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"DeleteComponent.php\" class=\"button-link\"><img src=\"textures/retry.png\" alt=\"Retry\" width=\"50\" height=\"50\"></a></div>";
            unset($_SESSION['sendingComponent']);
        } else if ($_SESSION['sendingComponent'] === false) {
            echo "<p>❌ Le composant n'a pas pu être supprimer, veuillez réessayer.</p>";
            echo "<a href=\"DeleteComponent.php\">Réessayer</a>";
        }
    } else {
        ?>
        <label>
            <select name="component" id="component">
                <?php
                $currentComp = "Default";

                foreach (RegistryEntry::getComponents() as $tuto) {
                    $selected = ($currentComp === $tuto['cno']) ? "selected" : "";
                    echo "<option value=\"" . htmlspecialchars($tuto['cno']) . "\" " . $selected . ">" . htmlspecialchars($tuto['cno']) . "</option>";
                }

                ?>
            </select>
        </label>
        <button type="submit">Supprimer le composant</button>
        <?php
    }
    ?>
</form>
</body>
</html>