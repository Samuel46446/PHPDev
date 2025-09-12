<?php

include_once "XMLable.php";

class XMLTest implements XMLable
{
    public function toXML()
    {
        $lesComptes = [
            ['login' => 'adil', 'organisation' => 'Turgot', 'budget' => 125],
            ['login' => 'alexandre', 'organisation' => 'Hautil', 'budget' => 35],
            ['login' => 'caroline', 'organisation' => 'Turgot', 'budget' => 5],
        ];
        $lesComptesXML = simplexml_load_string('<lesComptes/>');
        foreach ($lesComptes as $unCompte) {
            $unCompteXML = $lesComptesXML->addChild('compte');
            $unCompteXML->addChild('login', $unCompte['login']);
            $unCompteXML->addChild('organisation', $unCompte['organisation']);
            $unCompteXML->addChild('budget', $unCompte['budget']);
        }


        echo $lesComptesXML->asXML();
    }
}

$xml = new XMLTest();
$xml->toXML();