<?php

require_once('../pageVideoPattern.php');

$argument = array();

$argument['TitrePageWeb'] = 'Alim1';
$argument['NomFormation'] = 'Alimentation';
$argument['LienFormation'] = '../formationAlimentation.php';
$argument['NomChapitre'] = 'Chapitre 1';
$argument['LienChapitre'] = '.';
$argument['NomSousChapitre'] = 'SousChapitre1';
$argument['LienSousChapitre'] = 'Formations/Alimentation/alim1.php';
$argument['TitreVideo'] = 'Alimentation 1';
$argument['Video'] = 'videos/Alimentation/alim1.mp4';
$argument['LienPrecedent'] = 'Formations/formationAlimentation.php';
$argument['LienSuivant'] = 'Formations/formationAlimentation.php';

echo code($argument);

?>