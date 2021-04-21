<?php
require_once("../variables.php");
    $head =<<< EOT
        <meta charset="utf-8">
        <base href="..">
        <link rel="stylesheet" type="text/css" href="Css/Formations/cssFormation.css">
EOT;
// la fonction qui permettera d'écrire le code html selon les différentes données
function code($arguments,$chapitre)
{
    //l'en-tête et le haut de la page 
    global $enTete;
    global $head;
    
    // les codes html de chaque chapitre
    $chapitresCodeHtml = '';
    foreach($chapitre as $ch => $ssch)// on assemble les chapitres
    {
        $codeSousChapitre = '';
        foreach($ssch as $titre => $lien)// on assemble les sous chapitres
        {
            $a = <<< EOT
                <li> <a href="$lien" title="$titre">$titre</a> </li>
EOT;
            $codeSousChapitre .= "\n". $a ;
        }
        $b = <<< EOT
        <div id="$ch" class="chapitre">
            <button onclick="cache_affiche('$ch')"> - </button>
            <span class="chapitreTitre"> $ch </span>
            <div class="sousChapitreTitre" style="display: none;">
                <ul>
                $codeSousChapitre
                </ul>
            </div> 
        </div>
EOT;

        $chapitresCodeHtml .= "\n".$b;
    }

// le script javascript qui permet d'afficher et de cacher les sous chapitres
$scriptJS=<<< EOT
        <script>
            function cache_affiche(id = "")
            {
                var sousChapitre = document.getElementById(id).childNodes[5];
                if(sousChapitre.style.display == "none")
                {
                    sousChapitre.style.display = "block";
                    document.getElementById(id).childNodes[1].innerHTML = '+';
                }
                else
                {
                    sousChapitre.style.display = "none";
                    document.getElementById(id).childNodes[1].innerHTML = '-';
                }              
            }
        </script>
EOT;

// renvoie le code html en insérant les arguments
$codeHtml = <<<EOT
<!DOCTYPE html>
<html lang="fr">
    <head>
$head
        <title>{$arguments['titre']}</title>
        
    </head>

    <body>
$enTete
        <div id="body">
        <div id="description">
            <div id="image">
                <img {$arguments['image']}>
            </div>
            <div id="resume">
{$arguments['resume']}
            </div>
            <div id="divers">
{$arguments['divers']}
            </div>    
        </div>
       
        <br>
$chapitresCodeHtml

$scriptJS
        </div>
    </body>
</html>   
EOT;

    return $codeHtml;
}

?>