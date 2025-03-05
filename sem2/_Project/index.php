<!DOCTYPE html>
<html lang="fr">
    <head>
      <title> <?php include_once "Main.php"; echo Main::$NAME; ?> </title>
      <link rel="icon" href="textures/logo_minecraft.png" type="image/png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="css/title.css">
    </head>
    <body>
        <div class="content" id="content"></div>

        <table>
            <thead>
                <th>
                    <a class="button-link" href="java/quest1.html"> FORGE <img src="textures/logo_java.png" alt="" width=25px height=25px> </a>
                </th>
                <th>
                    <a class="button-link" href="tutorial_example_block_fabric.php"> FABRIC <img src="textures/logo_cs.png" alt="" width=25px height=25px> </a>
                </th>
                <th>
                    <a class="button-link" href="cpp/quest1.html"> NEOFORGE <img src="textures/logo_cpp.png" alt="" width=25px height=25px> </a>
                </th>
            </thead>
        </table>
        <script src="reset.js"></script>
  </body>
</html>