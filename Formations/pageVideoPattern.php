<?php
require_once('../../variables.php');

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
        
            <body id="corps">
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
                    <div id="blocVideoPlayer" onmouseover="afficheControl()" onmouseout="cacheControl()" >
                        
                        <video id="videoPlayer" title={$arguments["Video"]}" >
                            <source src={$arguments["Video"]} >
                             
                            Your browser does not support the video tag.
                        </video>

                        <div id="clickVideo" onclick="play()">
                        </div>

                        <div id="progression">
                            <span id="position"></span>
                            <span id="chargement"></span>
                        </div>
                        <div id="controlers">
                            <input type="image" src="images/Video/play.png" onclick="play();" id="playButton" >
                            <input type="image" src="images/Video/stop.png" onclick="stop()" id="stopButton" >
                            <div id="son" >
                                <div id="iconeSon">
                                    <img src="images/Video/sound.png">
                                </div>
                                <div id="ajusterSon">
                                    <div id="barre">
                                        <div id="volume">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p id="temps">  </p>

                            <div id="fullscreen" >
                                <input type=image src="images/Video/fullscreen.png" onclick="full()" id="playFull" >
                            </div>

                            <div id="vitesse" >
                                <div id="iconeVitesse">
                                    1.00x
                                </div>
                                <div id="tableVitesse">
                                    <ul>
                                        <li>2.00x</li>
                                        <li>1.50x</li>
                                        <li>1.25x</li>
                                        <li>1.00x</li>
                                        <li>0.75x</li>
                                    </ul>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div id="prochain">
                    <a id="precedent" href={$arguments["LienPrecedent"]}> Precedent</a>
                    <a id="suivant" href={$arguments["LienSuivant"]}> Suivant</a>
                </div>
            </body>
            <script type="text/javascript" src="JsScript/videoPlayer.js"></script>
        </html>
    
END;
    return $codeHtml;
}
?>