<?php
require_once("../Entete.php");
 $head = 
        '<meta charset="utf-8">
        <base href="..">
        <link rel="stylesheet" type="text/css" href="Css/Formations/cssFormation.css">';

// la fonction qui permettera d'écrire le code html selon les différentes données
function code($arguments,$chapitre,$sousChapitre)
{
    //ecrire l'en-tête et le haut de la page 
    global $enTete;
    global $head;
    // le patron de code. Première partie
    $patternHtml = <<<EOT
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            {$head}
            <title>{$arguments['titre']}</title>
        </head>

        <body>
            {$enTete}
        
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
            
EOT;
// le script javascript qui permettra d'afficher et cacher les sous chapitres
$scriptJS =<<< EOT
<script>
    function cache_affiche(idChapitre){
        var sousChapitre = document.getElementbyId("resume").childNodes[2];
        
        if(sousChapitre.style.display == "none")
        {
            sousChapitre.style.display = "block";
        }
        else
        {
            sousChapitre.style.display = "none";
        }
    }
</script>
EOT;

$patternHtml .= $scriptJS;
// les patrons de code pour les chapitres
$chapitreHtml = <<< EOT

            <div id="%s">
                <button onclick="cache_affiche("%s")"> + click on me</button>
                <span> %s </span>
                <div classe="sousChapitre" style="display: block;">
                    %s 
                </div>
            </div>

EOT;
$sousChapitreHtml = <<< EOT
<ul>
%s
                    </ul>
EOT;
// ecriture des chapitres
// permet de choisir le sous tableau des sous chapitres
// et donner un id unique à chaque bloc chapitre
$numeroChapitre = 0;
foreach($chapitre as $ch)
{
    $sousTitres = '';
    foreach($sousChapitre[$numeroChapitre] as $ssch)//ajout de chaque sous chapitre
    {
        $sousTitres .= "\t \t \t \t \t \t <li> <a href='".$ssch[1]."' title='lien vers sous chapitre'>".$ssch[0] ."</a> </li>";
        $sousTitres .= "\n ";
    }
    // on remplace les %s et concatène le tout
    $sousChapitreEcrit = sprintf($sousChapitreHtml,$sousTitres);
    $idChapitre = 'chapitre'.$numeroChapitre;
    $chapitreEcrit = sprintf($chapitreHtml,$idChapitre,$idChapitre,$ch,$sousChapitreEcrit);
    $patternHtml .= $chapitreEcrit;
    $numeroChapitre ++;
}

// les balises de fermetures
$patternHtml .='</body>';
$patternHtml .='</html>';

// renvoie le code html en insérant les arguments
return vsprintf($patternHtml,$arguments);
}

?>