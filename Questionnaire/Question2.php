<?php 
    require_once("./questionPattern.php");
    $codeHtml = $Partie1;
    $codeHtml .= '<form action="Questionnaire/Question2.php" method="GET" id=form1>
    <button type="submit" form="form1" value="Debutant" name="Debutant">Debutant</button>
    <button type="submit" form="form1" value="Avance" name="Avance">Avancé</button>
    </form>';
    $codeHtml .= $Partie2;
    echo $codeHtml;
?>