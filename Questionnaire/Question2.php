<?php 
    require_once('questionPattern.php');

    session_start();

    $arguments = array();

    $arguments['titre'] = 'Question1';
    $arguments['action'] = 'Questionnaire/Question3.php';
    $arguments['nom'] = 'depense';
    $arguments['valeur1'] = 'qualite';
    $arguments['valeur2'] = 'economie';
    $arguments['reponse1'] = 'Prêt à payer pour la qualité';
    $arguments['reponse2'] = 'Economiser un maximum';
    $arguments['precedent'] = 'Questionnaire/Question1.php';
    $arguments['nomPrecedent'] = 'accueil';

    sauvegardeReponse();

    echo code($arguments);
?>
