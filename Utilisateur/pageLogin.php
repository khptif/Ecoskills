<?php 
session_start();
require_once("../variables.php");
?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <title>Page d'inscription</title>
        <meta charset="utf-8">
        <base href="..">
        <link rel="stylesheet" type="text/css" href="Css/Utilisateur/cssLogin.css">
    </head>

    <body>
        <?php echo $enTete;?>

        <div id="formulaires">
            <div id="inscription">
                <h2>Inscription</h2>
                <form enctype="multipart/form-data" action="Utilisateur/login.php" method="POST">

                    <span class="input">
                    <label name="nom">Nom:</label>
                    <input type="text" name="nom">
                    <?php if($_SESSION['isErreur'] and $_SESSION['nomExistant']) echo '<p class="erreur"> Nom déjà existant </p>'?>
                    </span>
                    
                    <span class="input">
                    <label name="prenom">Prénom:</label>
                    <input type="text" name="prenom">
                    <?php if($_SESSION['isErreur'] and $_SESSION['nomExistant']) echo '<p class="erreur"> Prénom déjà existant </p>'?>
                    </span>

                    <span class="input">
                    <label name="age"> Age: </label>
                    <input type="number" min="0" max="120" name="age">
                    </span>

                    <span class="input">
                    <label name="sexe"> Sexe: </label>
                    <select name="sexe">
                        <option value="homme">homme</option>
                        <option value="femme">femme</option>
                    </select>
                    </span>
                    
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
                    <span class="input">
                    <label name="imageProfile"> L'image du profile </label>
                    
                    <input type="file" accept="image/*" name="imageProfile" value="choisir une image">
                    </span>
                    <input type="submit" name="type" value="inscription">
                </form>
            </div>
            <div id="login">
                <h2> Login </h2>
                <form action="Utilisateur/login.php" method="POST">
                <span class="input">
                    <label name="nom">Nom:</label>
                    <input type="text" name="nom">
                    <?php if( $_SESSION['isErreur'] and $_SESSION['nomNonExistant']) echo '<p class="erreur"> Nom non existant </p>'?>
                </span>
                <span class="input">
                    <label name="prenom">Prénom:</label>
                    <input type="text" name="prenom">
                    <?php if( $_SESSION['isErreur'] and $_SESSION['prenomNonExistant']) echo '<p class="erreur"> Prénom non existant </p>'?>
                </span>
                    <input type="submit" name="type" value="login">
                </form>
            </div>

          
        </div>
        <?php if($_SESSION['isErreur']) echo "<p class='erreurSQL'> {$_SESSION['erreur']} </p>"; ?>
    </body>
</html>

<?php 
$_SESSION['isErreur'] = FALSE;

?>