<?php 
    require_once('questionPattern.php');

    session_start();

    $arguments = array();

    $arguments['titre'] = 'Question1';
    $arguments['action'] = 'Questionnaire/Question2.php';
    $arguments['nom'] = 'niveau';
    $arguments['valeur1'] = 'debutant';
    $arguments['valeur2'] = 'avancee';
    $arguments['reponse1'] = 'debutant';
    $arguments['reponse2'] = 'avancee';
    $arguments['precedent'] = 'index.php';
    $arguments['nomPrecedent'] = 'accueil';

    sauvegardeReponse();

    echo code($arguments);
?>
