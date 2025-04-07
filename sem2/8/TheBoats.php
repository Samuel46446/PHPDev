<?php

require_once "PDFObject.php";
require_once "TravelerBoat.php";

$pdf = new PDFObject();

$oak_boat = new TravelerBoat(1,
    "Minecraft Oak Boat", 50, 50, 20, "oakboat.png");
$oak_boat->addEquipments(new Equipment(1, "Coffre"));

$ender_boat = new TravelerBoat(2,
    "Minecraft Ender Ship", 50, 50, 20, "endboat.png");
$ender_boat->addEquipments(new Equipment(2, "Salle du Coffre de l'End"));
$ender_boat->addEquipments(new Equipment(3, "Bar à Potions"));
$ender_boat->addEquipments(new Equipment(4, "Salle de navigation"));

$crashed_boat = new TravelerBoat(3,
    "Minecraft Crashed Boat", 50, 50, 20, "waterboat.png");
$crashed_boat->addEquipments(new Equipment(5, "Salle de navigation"));
$crashed_boat->addEquipments(new Equipment(6, "Salle de jeu"));
$crashed_boat->addEquipments(new Equipment(7, "Salle de mariage"));
$crashed_boat->addEquipments(new Equipment(8, "Réserve"));

$pdf->addBoat($oak_boat);
$pdf->addBoat($ender_boat);
$pdf->addBoat($crashed_boat);
$pdf->savePdf();

//$pdf = new FPDF('P', 'mm', 'A4');
//$pdf->AddPage();
//
//$dir2 = 'textures/';
//if (!is_dir($dir2)) {
//    mkdir($dir2, 0777, true);
//}
//// Définir la police
//$pdf->SetLeftMargin(40);
//$pdf->Image($dir2 . 'oakboat.png'); // Par exemple, 50mm de large, auto pour la hauteur
//
//// Ajuster la position du curseur après l'image pour éviter d'écrire dessus
//
//$pdf->SetFont('Arial', 'B', 16);
//
//// Ajouter du texte
//$pdf->Cell(40, 10, 'Hello World!');
//$pdf->Ln();
//$pdf->SetLeftMargin(60);
//$pdf->Cell(100, 10,
//    iconv('UTF-8', 'ISO-8859-1//TRANSLIT',
//        "Ceci est un PDF généré avec FPDF."));
//
//$dir = 'gen/';
//if (!is_dir($dir)) {
//    mkdir($dir, 0777, true);
//}
//$pdf->Output($dir . "boats.pdf", 'F');

?>