<?php
require_once "Pays.php";
require_once "Ville.php";
require_once "Langue.php";

//pays et villes
$france=new Pays(1,'France');
$paris=new Ville(1,'Paris');
$toulouse=new Ville(2,'Toulouse');
$france->setLaCapitale($paris);
$france->ajouterVille($paris);
$france->ajouterVille($toulouse);

$espagne=new Pays(2,'Espagne');
$madrid=new Ville(3,'Madrid');
$barcelone=new Ville(4,'Barcelone');
$espagne->setLaCapitale($madrid);
$espagne->ajouterVille($barcelone);
$espagne->ajouterVille($madrid);

//QUESTION3 METHODE Pays::getNomCapitale() A CODER ET TESTER
var_dump($france->getNomCapitale());    //doit afficher Paris
var_dump($espagne->getNomCapitale());   //doit afficher Madrid

//METHODE Ville::getNomPays() A CODER ET TESTER
var_dump($toulouse->getNomPays());      //doit afficher France
var_dump($madrid->getNomPays());        //doit afficher Espagne


//langues parlées
$francais=new Langue(1,'Francais');
$espagnol=new Langue(2,'Espagnol');
$occitan=new Langue(3,'Occitan');
$arabe=new Langue(4,'Arabe');

$france->ajouterLangue($francais,TRUE);
$france->ajouterLangue($arabe,FALSE);
$france->ajouterLangue($occitan,FALSE);

$espagne->ajouterLangue($espagnol,TRUE);
$espagne->ajouterLangue($occitan,FALSE);

//METHODE Pays::getLangueNonOfficielle() A CODER ET TESTER
$lesLangues=$france->getLangueNonOfficielle();
foreach($lesLangues as $uneLangue){
    echo $uneLangue->getNom() . "\n";
}                                       //doit afficher Arabe et Occitan
?>