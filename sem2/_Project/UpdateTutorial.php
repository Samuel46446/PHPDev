<?php
include_once "Main.php";
include_once "Tutorial.php";

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["title"]) && !empty($_POST["version"] &&
    !empty($_POST["about"]) && !empty($_POST["description"]) && !empty($_POST["finaldesc"]))) {
        $title = $_POST['title'];
        $version = $_POST['version'];
        $about = $_POST['about'];
        $description = $_POST['description'];
        $finalDesc = $_POST['finaldesc'];
        $_SESSION['sendingTutorial'] = true;

        $tutorial = new Tutorial($title, $version, $about, $description, $finalDesc);

        $id = AttributeFetcher::getTutorialIdByName($_POST['tutoriel']);
        SwitchRegistry::updateTutorialToBDD($id, $tutorial);
    }
    else
    {
        $_SESSION['sendingTutorial'] = false;
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

<form action="UpdateTutorial.php" method="POST">
    <?php
    if (isset($_SESSION['sendingTutorial'])) {
        if ($_SESSION['sendingTutorial']) {
            echo "<p>✅ Vous avez créé le tutoriel.</p>";
            echo "<div class=\"home\"><a href=\"index.php\" class=\"button-link\"><img src=\"textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
            echo "<div class=\"home\"><a href=\"UpdateTutorial.php" . $_SESSION['titleTutorial'] . "\" class=\"button-link\"><img src=\"textures/components.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>";
        } else if ($_GET['sendingTutorial'] === false) {
            echo "<p>❌ Le tutoriel n'a pas pu être créé, veuillez réessayer.</p>";
            echo "<a href=\"UpdateTutorial.php\">Réessayer</a>";
        }
    } else {
        ?>
        <label>
            <select name="tutoriel" id="tutoriel">
                <?php
                $currentTuto = "Default";

                foreach (RegistryEntry::getTutorials() as $tuto) {
                    $selected = ($currentTuto === $tuto['title']) ? "selected" : "";
                    echo "<option value=\"" . htmlspecialchars($tuto['title']) . "\" " . $selected . ">" . htmlspecialchars($tuto['title']) . "</option>";
                }

                ?>
            </select>
        </label>
        <label>
            <input type="text" name="title" placeholder="Titre du tutoriel" required>
        </label>
        <label>
            <input type="text" name="version" placeholder="Version Minecraft du tutoriel" required>
        </label>
        <label>
            <input type="text" name="about" placeholder="Sujet du tutoriel" required>
        </label>
        <label>
            <input type="text" name="description" placeholder="Description du tutoriel" required>
        </label>
        <label>
            <input type="text" name="finaldesc" placeholder="Description final du tutoriel" required>
        </label>
        <button type="submit">Modifier le tutoriel</button>
        <?php
    }
    ?>
</form>
</body>
</html>