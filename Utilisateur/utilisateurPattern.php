<?php
require_once("../variables.php");

function code($arguments)
{
    global $enTete;
    // les différentes tâches accomplies
    $tachesCodes = ' ';
    for($i=0;$i<$arguments['nombreHabitudes'] ;$i++)
    {
        $x = <<< END
            <div class="tachesAccomplies fondColor">
                <div id="logo"><img src="{$arguments[$i]['logoTache']}" alt=""></div>
                <div id="texteTache"> 
                    <span id="phrase"><strong> {$arguments['nom']} {$arguments['prenom']} </strong> a accompli {$arguments[$i]['tacheAccompli']}</span>
                    <span id="date"> le {$arguments[$i]['dateTacheAccompli']} </span>
                </div>
            </div>


END;

        $tachesCodes .= $x;
    }

    // phrase au pluriel ou au singulier
    $phrase = '';
    if($arguments['nombreHabitudes']>1)
    {
        $phrase = 'habitudes durables adoptées';
    }
    else
    {
        $phrase = 'habitude durable adoptée';
    }

    // le code html final
    $codeHtml = <<< END
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
            <base href="../">
            <link rel="stylesheet" type="text/css" href="Css/Utilisateur/cssUtilisateur.css">
    </head>
    
    <body>
$enTete
    <div id="body">
        <div id="description" class="fondColor">
    
            <div id="fond">
            </div>
                
            <div id="objetDescription">
    
                <img id="utilisateur" src="{$arguments['imageUtilisateur']}" title="Nom prénom" alt="Nom prénom">
                <div id="info">
                    <span id="nom">
                        {$arguments['nom']}
                    </span>
                    <span id="prenom">
                        {$arguments['prenom']}
                    </span>
                    <span id="anciennete">
                        Membre depuis {$arguments['date']}
                    </span>
                    <span id="commune">
                        Commune de {$arguments['commune']}
                    </span> 

                </div>

            </div>

        </div>
    


        <div id="progression" class="fondColor">
            <span id="nombreHabitude">
            {$arguments['nombreHabitudes']} $phrase
            </span>
    
            <div id="pourcentage">
                <div id="barre">
                    <span id="accompli" style="width: {$arguments['pourcentage']}%;"></span>
                </div>
            </div>
    
            <div id="trophee">
                <img src="images/Utilisateur/trophee.jpg" >
            </div>
    
        </div>
   


$tachesCodes
    </div>
        </body>
    
    </html>
END;

    return $codeHtml;
}


?>

