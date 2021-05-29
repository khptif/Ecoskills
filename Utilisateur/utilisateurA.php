<?php

session_start();

require_once('../Entete.php');
require_once('utilisateurPattern.php');

$arguments = array();
$arguments['imageUtilisateur'] = $_SESSION['AdresseImage'];
$arguments['nom'] = $_SESSION['Nom'];
$arguments['prenom'] = $_SESSION['Prenom'];
$arguments['date'] = '23.03.2021';
$arguments['commune'] = $_SESSION['Commune'];
$arguments['nombreHabitudes'] = 2;
$arguments['pourcentage'] = 40;

$arguments[0] = array();
$arguments[0]['logoTache'] = 'images/Alimentation1.jpg';
$arguments[0]['tacheAccompli'] = 'Alimentation 1';
$arguments[0]['dateTacheAccompli'] = '23.03.2021';

$arguments[1]['logoTache'] = 'images/Alimentation1.jpg';
$arguments[1]['tacheAccompli'] = 'Alimentation 1';
$arguments[1]['dateTacheAccompli'] = '23.03.2021';

echo code($arguments);
?>