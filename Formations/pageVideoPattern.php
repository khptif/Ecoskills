<?php
require_once('../../Entete.php');

$head = 
        '<meta charset="utf-8">
        <base href="../../">
        <link rel="stylesheet" type="text/css" href="Css/Formations/cssPageVideo.css">';

function code($arguments)
{
            
    global $head;
    global $enTete;

    $codeHtml =<<< END

        <!DOCTYPE html>
        <html lang="fr">
            <head>
                $head
                <title>{$arguments["Titre"]}</title>
            </head>
        
            <body>
                $enTete
                <div id="chapitrage">
                    <a id="formationLien" href={$arguments["LienFormation"]}> {$arguments["NomFormation"]}</a>
                    >
                    <a id="ChapitreLien" href={$arguments["LienChapitre"]} > {$arguments["NomChapitre"]}</a>
                    >
                    <a id="SousChapitre" href={$arguments["LienSousChapitre"]}> {$arguments["NomSousChapitre"]}</a>    
                </div>
        
                <div id="video">
                    <h2> {$arguments["TitreVideo"]} </h2>
                    <video controls title={$arguments["Video"]}>
                        <source src={$arguments["Video"]}>
                             
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div id="prochain">
                    <a id="precedent" href={$arguments["LienPrecedent"]}> Precedent</a>
                    <a id="suivant" href={$arguments["LienSuivant"]}> Suivant</a>
                </div>
            </body>
        </html>
    
END;
    return $codeHtml;
}
?>