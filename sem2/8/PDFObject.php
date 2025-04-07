<?php

require_once('..\..\..\libPHP\FPDF\fpdf.php'); //"FPDF.php";
class PDFObject extends FPDF
{
    private array $boats;

    public function __construct()
    {
        parent::__construct();
    }

    public function addBoat(AbstractBoat $boat) : void
    {
        $this->boats[] = $boat;
    }

    public function savePdf(): void
    {
        $this->AddPage();

        for($i=0;$i<count($this->boats);$i++)
        {
            if($this->boats[$i] instanceof TravelerBoat)
            {
                $this->SetLeftMargin(40);
                $this->Image('textures/'.$this->boats[$i]->getPictureLocation(), $this->GetX(), $this->GetY(), 100, 100);
                $this->SetY($this->GetY()+100+5);
                $this->Ln();
                $this->SetFont('Arial', 'B', 16);
                $this->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT','Nom du bateau : ' . $this->boats[$i]->getName()));
                $this->Ln();
                $this->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT','Longueur : ' . $this->boats[$i]->getLength()));
                $this->Ln();
                $this->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT','Largeur : ' . $this->boats[$i]->getWidth()));
                $this->Ln();
                $this->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT','Vitesse : ' . $this->boats[$i]->getSpeed()));
                $this->Ln();
                $this->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT','Liste des équipements du bateau : '));
                $this->Ln();

                for($k=0;$k<count($this->boats[$i]->getEquipments());$k++)
                {
                    $this->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', '- ' . $this->boats[$i]->getEquipments()[$k]->__toString()));
                    $this->Ln();
                    if ($this->GetY() > 260) {
                        $this->AddPage();
                        $this->SetY(10); // Remonter un peu après ajout de page
                    }
                }

                if ($this->GetY() > 260) {
                    $this->AddPage();
                    $this->SetY(10); // Remonter un peu après ajout de page
                }
                $this->Ln();
            }

        }
        $this->Output("gen/boats.pdf", 'F');


//        $this->SetFont('Times','',12);
//
//        $this->AliasNbPages();
//        $this->AddPage();
//        $this->SetFont('Times','',12);
//        for($i=1;$i<=40;$i++)
//            $this->Cell(0,10,'Impression de la ligne num�ro '.$i,0,1);
//        $this->Output();
    }

    /**
     * @return array
     */
    public function getBoats(): array
    {
        return $this->boats;
    }

    /**
     * @return FPDF
     */
    public function getPdf(): FPDF
    {
        return $this;
    }
}