<?php 
    require_once('questionPattern.php');

    session_start();

    $arguments = array();

    $arguments['titre'] = 'Question3';
    $arguments['action'] = 'Questionnaire/Question4.php';
    $arguments['nom'] = 'temps';
    $arguments['valeur1'] = 'lievre';
    $arguments['valeur2'] = 'tortue';
    $arguments['reponse1'] = 'Pas une minute à perdre';
    $arguments['reponse2'] = "J'aime prendre mon temps";
    $arguments['precedent'] = 'Questionnaire/Question2.php';
    $arguments['nomPrecedent'] = 'accueil';

    sauvegardeReponse();

    echo code($arguments);
?>