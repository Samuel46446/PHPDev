<?php
include "Main.php";

$tuto = $_GET['tuto'] != null ? $_GET['tuto'] : "Bloc";
$setTuto = $_GET['tuto'] != null ? $_GET['tuto'] : "Bloc";
$modLoader= $_GET['modloader'] != null ? $_GET['modloader'] : "forge";
$setTuto1 = lcfirst($setTuto); //"bloc";

$tabTuto = Main::getTutorialFromName($setTuto);
$modLoaderID = Main::getLoaderIdByName($_GET['modloader'] != null ? $_GET['modloader'] : "forge");

$icon = Main::getLogoLoaderById($modLoaderID);

$tabComponents = Main::getComponentsByTutorialNameAndLoader($modLoaderID, $setTuto1);
$tabMinecraftComponents = Main::getComponentsByTutorialNameAndLoader(4, $setTuto1);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modding Tutorial - <?php echo $tabTuto['title']; ?></title>
    <?php echo "<link rel=\"icon\" href=\"textures/" . $icon . ".png\" type=\"image/x-icon\">"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
   <style>
       h1{
           color: #5CEB95;
           margin-left: 20px;
       }
       h2{
           color: #1FC946;
           margin-left: 20px;
       }
       p{
           color: #F525E3;
           margin-left: 40px;
       }
       body {
                background-color: rgb(17, 17, 17);
                font-family: Arial, Helvetica, sans-serif;
                margin: 0;
            }
            pre {
                background-color: rgb(17, 17, 17);
                padding: 10px;
                border-radius: 5px;
                overflow-x: auto;
               display: inline-block; /* Ajuste la largeur au contenu */
               max-width: 100%; /* Empêche le dépassement */
               border: 1px solid rgb(17, 17, 17);
               white-space: pre-wrap; /* Permet les retours à la ligne si besoin */
            }
            .language-java {
                border-radius: 10px;
            }
            .language-json {
                border-radius: 10px;
            }
            .version{
                color: #F525E3;
                display: flex;
                justify-content: flex-end;
                margin-right: 20px; /* Pousse l'élément vers la droite */
            }
       select {
           background-color: #333;
           color: white;
           padding: 10px;
           border: none;
           border-radius: 5px;
           margin-left: 20px;
           margin-bottom: 20px;
       }
   </style>
</head>
<body>
<select name="modLoader" id="modloaders">
    <option value="forge" <?= ($modLoader == "forge") ? "selected" : ""; ?>>
        forge
    </option>
    <option value="fabric" <?= ($modLoader == "fabric") ? "selected" : ""; ?>>
        fabric
    </option>
    <option value="neoforge" <?= ($modLoader == "neoforge") ? "selected" : ""; ?>>
        neoforge
    </option>
</select><select name="tuto" id="tutos">
    <?php
    include_once "Tutorial.php";

    $currentTuto = $_GET['tuto'] ?? "Bloc";

    foreach (Tutorials::getTutorials() as $tuto) {
        $selected = ($currentTuto === $tuto['title']) ? "selected" : "";
        echo "<option value=\"" . htmlspecialchars($tuto['title']) . "\" " . $selected . ">" . htmlspecialchars($tuto['title']) . "</option>";
    }
    ?>
</select>
<script>
    document.getElementById('modloaders').addEventListener('change', function() {
        const params = new URLSearchParams(window.location.search);
        params.set('modloader', this.value);
        window.location.search = params.toString();
    });

    document.getElementById('tutos').addEventListener('change', function() {
        const params = new URLSearchParams(window.location.search);
        params.set('tuto', this.value);
        window.location.search = params.toString();
    });
</script>
    <header>
        <h1 class="version"><?php echo "Version Tutoriel : " . $tabTuto['version']; ?></h1>
        <h1><?php echo $tabTuto['about'];?></h1>
        <p><?php echo $tabTuto['description']; ?>
            <?php
            if($_GET['modloader'] != null)
            {
                if($_GET['modloader'] == "fabric")
                {
                    echo "la fabric api";
                }
                else if($_GET['modloader'] == "neoforge")
                {
                    echo "l'api neoforge";
                }
                else
                {
                    echo "l'api forge";
                }
            }
            else
            {
                echo "minecraft";
            }
            ?>.</p>
        <ul>
            <?php

            foreach ($tabComponents as $component) {

                if($component['cno'] == 'java' . $setTuto1 . '1')
                {
                    echo Main::getBaliseFromCno($component['cno'], $component['description'], $component['code'], $component['lno']);
                }
            }

            foreach ($tabComponents as $component) {

                if($component['cno'] != 'java'. $setTuto1 .'1')
                {
                    echo Main::getBaliseFromCno($component['cno'], $component['description'], $component['code'], $component['lno']);
                }
            }
            ?>

            <?php

            foreach ($tabMinecraftComponents as $component) {
                echo Main::getBaliseFromCno($component['cno'], $component['description'], $component['code'], $component['lno']);
            }
            ?>
        </ul>
        <?php echo "<h2>" . $tabTuto['finaldesc'] . "</h2>"; //Cela nous donne un bloc tout rose ?>
        <div class="container">
            <div id="branding">
                <h1>Autres :</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php">DataGenerator</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <footer>
        <p>&copy; 2025 Minecraft Modding Tutorial. All rights reserved.</p>
    </footer>
</body>
</html>