<?php 

require_once('formationPattern.php');

$arguments = array();

$arguments['titre'] = 'Formation Alimentation';
$arguments['image'] = 'src="images/Alimentation1.jpg" title="Alimentation" alt="image Alimentation"';
$arguments['resume'] = <<< EOT
                <h1>Alimentation</h1>
                <h2>Auteurs</h2>
                <p>Resumé de la formationrggggggggggggggggggggggggggggggg
                ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwfffffffffff
                fwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwfffffffffffffffffffffffffffffffffffffffffffffffff
                qqqqqqqqqqqqqqqqqqqqqqqqqqqeeeeeeeeeeeeeeeeeeeeeeeee</p>
EOT;
$arguments['divers'] = <<< EOT
                <span id="duree"><img src="images/temps.png" title="durée"> <span id="temps" class="lettreDivers">2h30</span></span>
                <span id="geste" class="lettreDivers">Geste</span>
                <span id="nombre" class="lettreDivers">255 personnes</span>
EOT;
$chapitres = array();

$ch = 'Alimentation';
$chapitres[$ch]['Alim1'] = 'Formations/Alimentation/alim1.php';
$chapitres[$ch]['sous-chapitre2'] = '';

$ch = 'Chapitre 2';
$chapitres[$ch]['sous-chapitre 1'] = '';
$chapitres[$ch]['sous-chapitre 2'] = '';

echo code($arguments,$chapitres);
 ?>


