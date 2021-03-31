<?
require_once("../Entete.php");
 
function sauvegardeReponse()
{
        foreach($_GET as $cle => $valeur)
        {
                $_SESSION[$cle] = $valeur;
        }
}

function code($arguments)
{
global $enTete;

$htmlCode= <<<END
<!DOCTYPE html>
        <html lang="fr">

                <head>
                        <meta charset="utf-8">
                        <title>{$arguments['titre']}</title>
                        <base href="..">
                        <link rel="stylesheet" type="text/css" href="Css/Questionnaire/cssQuestion.css">
                </head>

                <body>

                        $enTete

                        <br>
                        <div id="Texte">
                            <p>Apprenons à vous connaître!</p>
                        </div>

                        <div id="Question">
                                <p> Vous êtes plutôt </p>
                                <form action="{$arguments['action']}" method="GET">
                                        <button type="submit" name="{$arguments['nom']}" value="{$arguments['valeur1']}">{$arguments['reponse1']}</button>
                                        <button type="submit" name="{$arguments['nom']}" value="{$arguments['valeur2']}">{$arguments['reponse2']}</button>
                                </form>
                        </div>

                        <div id="lien">
                                <a id="precedent" href="{$arguments['precedent']}" ><img src="images/Questionnaire/flecheGauche.png" title="{$arguments['nomPrecedent']}"></a>
                                <a id="accueil" href="index.php"><img src="images/LogoPageAccueil.png" title="accueil"></a>
                        </div>

                        <div>
                        les reponses
                        {$arguments['get']}
                        </div>
                </body>

        </html>
END;

return $htmlCode;
}
?>