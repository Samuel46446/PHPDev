<?php

use sem2\_ProjectVersionMVC\models\AttributeFetcher;
use sem2\_ProjectVersionMVC\models\RegistryEntry;

require_once 'registries/AttributeFetcher.php';
require_once 'registries/RegistryEntry.php';

if(!isset($_GET['tuto'])) {
    $_GET['tuto'] = "Bloc";
}

if(!isset($_GET['modLoader'])) {
    $_GET['modLoader'] = "forge";
}

$tuto = $_GET['tuto'] ?? "Bloc";
$modLoader = $_GET['modLoader'] ?? "forge";
$minTuto = lcfirst($tuto);

$tabTuto = AttributeFetcher::getTutorialByName($tuto);
$modLoaderID = AttributeFetcher::getLoaderIdByName($_GET['modLoader'] != null ? $_GET['modLoader'] : "forge");

$icon = AttributeFetcher::getLogoLoaderById($modLoaderID);

$tabComponents = RegistryEntry::getComponentsByTutorialNameAndLoader($modLoaderID, lcfirst($tuto));
$tabMinecraftComponents = RegistryEntry::getComponentsByTutorialNameAndLoader(4, lcfirst($tuto));
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
    <link rel="stylesheet" type="text/css" href="css/title.css">
</head>
<body>
<label for="modLoader"></label><select name="modLoader" id="modLoader">
    <option value="forge" <?= ($modLoader == "forge") ? "selected" : ""; ?>>
        forge
    </option>
    <option value="fabric" <?= ($modLoader == "fabric") ? "selected" : ""; ?>>
        fabric
    </option>
    <option value="neoforge" <?= ($modLoader == "neoforge") ? "selected" : ""; ?>>
        neoforge
    </option>
</select>
<label for="tuto"></label><select name="tuto" id="tuto">
    <?php

    $currentTuto = $_GET['tuto'] ?? "Bloc";

    foreach (RegistryEntry::getTutorials() as $tuto) {
        $selected = ($currentTuto === $tuto['title']) ? "selected" : "";
        echo "<option value=\"" . htmlspecialchars($tuto['title']) . "\" " . $selected . ">" . htmlspecialchars($tuto['title']) . "</option>";
    }
    ?>
</select>
<script>
    document.getElementById('modLoader').addEventListener('change', function() {
        const params = new URLSearchParams(window.location.search);
        params.set('modLoader', this.value);
        window.location.search = params.toString();
    });

    document.getElementById('tuto').addEventListener('change', function() {
        const params = new URLSearchParams(window.location.search);
        params.set('tuto', this.value);
        window.location.search = params.toString();
    });
</script>
    <header>
        <?php echo "<div class=\"homeTuto\"><a href=\"index.php\" class=\"button-link\"><img src=\"textures/home_button.png\" alt=\"Home\" width=\"50\" height=\"50\"></a></div>"; ?>
        <h1 class="h1VersionTuto"><?php echo "Version Tutoriel : " . $tabTuto['version']; ?></h1>
        <h1 class="h1Tuto"><?php echo $tabTuto['about'];?></h1>
        <p class="pTuto"><?php echo $tabTuto['description']; ?>
            <?php
            if($_GET['modLoader'] != null)
            {
                if($_GET['modLoader'] == "fabric")
                {
                    echo "la fabric api";
                }
                else if($_GET['modLoader'] == "neoforge")
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

                if($component['cno'] == "java" . lcfirst($tabTuto['title']) . "1")
                {
                    echo RegistryEntry::getBaliseFromCno($component['cno'], $component['description'], $component['code'], $component['lno']);
                }
            }

            foreach ($tabComponents as $component) {

                if($component['cno'] != "java". lcfirst($tabTuto['title']) ."1")
                {
                    echo RegistryEntry::getBaliseFromCno($component['cno'], $component['description'], $component['code'], $component['lno']);
                }
            }
            ?>

            <?php

            foreach ($tabMinecraftComponents as $component) {
                echo RegistryEntry::getBaliseFromCno($component['cno'], $component['description'], $component['code'], $component['lno']);
            }
            ?>
        </ul>
        <?php echo "<h2 class=\"h2Tuto\">" . $tabTuto['finaldesc'] . "</h2>"; ?>
    </header>
    <footer>
        <p class="pCopyright">&copy; 2025 Minecraft Modding Tutorial. All rights reserved.</p>
    </footer>
</body>
</html>