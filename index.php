<?php require_once("variables.php");?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Ecoskill</title>
        <link rel="stylesheet" type="text/css" href="Css/cssIndex.css">

    </head>

    <body style="background-image: url('images/background.jpg')">
        <?php echo $enTete;?>
        </div>
        <br>
        <div id="Lien_Questionnaires">
            <p>Trouvez une formation sur mesure.</p>
            <a href="Questionnaire/Question1.php" target="_self" > <div id="Lien">Trouver Ma formation ideale</div></a>
        </div>
        <br>
        <div id="Formations">
            <div id="Alimentation" class="formation">
                <p>Alimentation</p> <br>
                <a href="Formations/formationAlimentation.php" target="_self" ><img src="images/Alimentation1.jpg" alt="Formation1" title="Formation Alimentation 1"></a>
                <a href="" target="_self" ><img src="images/Alimentation2.jpg" alt="Formation2" title="Formation Alimentation 2"></a>
                <a href="" target="_self" ><img src="images/Alimentation3.jpg" alt="Formation3" title="Formation Alimentation 3"></a>
            </div>
        </div>
        <br>
        <div id="Formations">
            <div id="Consommation" class="formation">
                <p>Consommation</p> <br>
                <a href="" target="_self" ><img src="images/Consommation1.jpg" alt="Formation1" title="Formation Consommation 1"></a>
                <a href="" target="_self" ><img src="images/Consommation2.jpg" alt="Formation2" title="Formation Consommation 2"></a>
            </div>
        </div>
        <br>
        <div id="Formations">
            <div id="Dechet" class="formation">
                <p>Dechet</p> <br>
                <a href="" target="_self" ><img src="images/Dechet1.jpg" alt="Formation1" title="Formation Dechet 1"></a>
                <a href="" target="_self" ><img src="images/Dechet2.jpg" alt="Formation2" title="Formation Dechet 2"></a>
            </div>
        </div>
    </body>
</html>