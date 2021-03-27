<?php 

require_once('formationPattern.php');

$arguments = array();

$arguments['titre'] = 'Formation Alimentation';
$arguments['image'] = 'src="images/Alimentation1.jpg" title="Alimentation" alt="image Alimentation"';
$arguments['resume'] ='<h1>Alimentation</h1>
<h2>Auteurs</h2>
<p>Resumé de la formationrggggggggggggggggggggggggggggggg
gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg</p>';
$arguments['divers'] = '<span id="duree"><img src="images/temps.png" title="durée"> <span id="temps">2h30</span></span>
<span id="geste">Geste</span>
<span id="nombre">255 personnes</span>';

$chapitre = array();
$chapitre[] = 'Alimentation';
$chapitre[] = 'Chapitre 2';


$sousChapitre = array();
$sousChapitre[] = array();

$sousChapitre[0][0][] = 'Alim1';
$sousChapitre[0][0][] = 'Formations/Alimentation/alim1.php';

$sousChapitre[0][1][] = 'sous-chapitre 2';
$sousChapitre[0][1][] = '';

$sousChapitre[1][0][] = 'sous-chapitre 1';
$sousChapitre[1][0][] = '';

$sousChapitre[1][1][] = 'sous-chapitre 2';
$sousChapitre[1][1][] = '';

echo code($arguments,$chapitre,$sousChapitre);
 ?>


