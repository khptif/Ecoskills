<?php 
    require_once('questionPattern.php');

    session_start();

    $arguments = array();

    $arguments['titre'] = 'Question4';
    $arguments['action'] = 'Questionnaire/Reponses.php';
    $arguments['nom'] = 'detail';
    $arguments['valeur1'] = 'profondeur';
    $arguments['valeur2'] = 'direct';
    $arguments['reponse1'] = "Envie d'aller en profondeur";
    $arguments['reponse2'] = "Allez droit au but";
    $arguments['precedent'] = 'Questionnaire/Question3.php';
    $arguments['nomPrecedent'] = 'accueil';

    sauvegardeReponse();

    echo code($arguments);
?>