<?php 
session_start();
require_once("../variables.php");

// oblige à utiliser le protocol https
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $location);
    exit();
}

// liste des champs
$champs = array('nom','prenom','email','adresse','localite','commune','sexe','dateNaissance','imageProfile');

// fonction qui produit le code html d'un champ

function champCode($nom,$titre,$type,$messageErreur)
{
    $erreur = '';
    if($_SESSION['champsVides'] and in_array($nom,$_SESSION['champsARemplir']))
    {
        $erreur = <<<END
                    <p class="erreur"> $messageErreur </p>
END;
    } 
    

    $valeur = '';
    if($_SESSION['motPasseNonConfirme'] or $_SESSION['emailExistant'] or $_SESSION['emailNonAccessible'])
    {
        $valeur = $_SESSION['valeursPrecedentes'][$nom];
    }
    $code= <<< END
<span class="input">
                    <label name=$nom>$titre:</label>
                    <input type=$type name=$nom id=$nom value=$valeur>
                    $erreur    
                </span>
END;


    return $code;
}

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

                    <?php echo champCode('nom','Nom','text','Nom Obligatoire'); ?>
                    <?php if($_SESSION['isErreur'] and $_SESSION['nomExistant']) echo '<p class="erreur"> Nom déjà existant </p>'?>

                    <?php echo champCode('prenom','Prénom','text','Prénom Obligatoire'); ?>
                    <?php if($_SESSION['isErreur'] and $_SESSION['nomExistant']) echo '<p class="erreur"> Prénom déjà existant </p>'?>
                    
                    <?php echo champCode('email','E-mail','text','Email Obligatoire'); ?>
                    <?php if($_SESSION['isErreur'] and $_SESSION['emailExistant']) echo '<p class="erreur"> E-mail déjà existant </p>'?>
                    <?php if($_SESSION['isErreur'] and $_SESSION['emailNonAccessible']) echo '<p class="erreur"> Impossible d\'envoyer un email à cette adresse </p>'?>

                    <?php echo champCode('adresse','Adresse','text','Adresse Obligatoire'); ?>
                   
                    <?php echo champCode('localite','Localite','text','Localite Obligatoire'); ?>
                   
                    <?php echo champCode('commune','Commune','text','Commune Obligatoire'); ?>
                    
                    <?php echo champCode('dateNaissance','Date de naissance','date','Date Obligatoire'); ?>
                    
                    <span class="input">
                    <label name="sexe"> Sexe: </label>
                    <select name="sexe" id="sexe">
                        <option value="homme">homme</option>
                        <option value="femme">femme</option>
                    </select>
                    </span>
                    
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000">

                    <span  class="inputFile" >
                    <label name="imageProfile"> L'image du profile </label>
                    <?php $valeurImage= 'choisir une image'; if($_SESSION['motPasseNonConfirme']){$valeurImage = $_SESSION['valeursPrecedentes'];} ?>
                    <input type="file" accept="image/*" name="imageProfile" value="<?php echo $valeurImage;?>" id="imageProfile">
                    </span>

                    <span class="input">
                    <label for="motPasse"> Mot de passe: </label>
                    <input type="password" name="motPasse">
                    <?php if($_SESSION['champsVides'] and in_array('motPasse',$_SESSION['champsARemplir'])) echo '<p class="erreur"> Mot de passe Obligatoire </p>'?>
                    </span>

                    <span class="input">
                    <label for="confirmeMotPasse"> Confirmation: </label>
                    <input type="password" name="confirmeMotPasse">
                    <?php if($_SESSION['champsVides'] and in_array('confirmeMotPasse',$_SESSION['champsARemplir'])) echo '<p class="erreur"> Confirmez le mot de passe </p>'?>
                    <?php if($_SESSION['motPasseNonConfirme']) echo '<p class="erreur"> Mauvaise Confirmation. Ressayez! </p>'?>
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
                <span class="input">
                    <label for="motPasse"> Mot de passe: </label>
                    <input type="password" name="motPasse">
                    <?php if( $_SESSION['isErreur'] and $_SESSION['mauvaisMotPasse']) echo '<p class="erreur"> Mauvais Mot de Passe </p>'?>
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