<?php

    require_once('questionPattern.php');
    session_start();

    sauvegardeReponse();

    foreach($_SESSION as $cle => $valeur)
    {
        echo $cle. ' : '. $valeur .'<br>';
    }
?>