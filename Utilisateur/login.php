<?php

session_start();

//////// Les paramètres de la base de donnée ////////////////////

$servername = "localhost";
$username = "fatih";
$password = "12345";
$BD ="ecoSkillBD";

/////////////////////////////////////////////////////////////////


///////// Les différents variable d'erreur /////////////////////////////

// on réinitialise les variables d'erreurs

$_SESSION['isErreur'] = FALSE;
$_SESSION['nomExistant'] = FALSE;
$_SESSION['nomNonExistant'] = FALSE;
$_SESSION['emailExistant'] = FALSE;
$_SESSION['prenomNonExistant'] = FALSE;
$_SESSION['champsVides'] = FALSE;
$_SESSION['motPasseNonConfirme'] = FALSE;
$_SESSION['mauvaisMotPasse'] = FALSE;
$_SESSION['emailNonAccessible'] = FALSE;

///////////////////////////////////////////////////////////////////////////////


//////////////// TEST CONNECTION BASE de DONNEE ////////////////////////////////

// Create connection
$conn = mysqli_connect($servername, $username, $password,$BD);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// choisi encodage
$query = "SET NAMES utf8";
$result = $conn->query($query);
if(!$result) die("Erreur Encodage" . mysqli_connect_error());

////////////////////////////////////////////////////////////////////////////////////


/////////////// DEMANDES d'inscription ou de connection /////////////////////////////


//////////////// INSCRIPTION ////////////////////

if($_POST['type']=='inscription')
{
  /////// Variables utilisé le long de l'inscription //////

  $champs = array('nom','prenom','email','adresse','localite','commune','dateNaissance','sexe','motPasse','confirmeMotPasse');

  ////// Vérification de champs laissés vides ////

  $champs_vide = array();
  foreach($champs as $champ)
  {
    if($_POST[$champ] == '')
    {
      $champs_vide[] = $champ;
      $_SESSION['champsVides'] = TRUE;
    }
  }
  // si un champs n'est pas rempli, on revient à la page de login
  if($_SESSION['champsVides'])
  {
    $_SESSION['champsARemplir'] = $champs_vide;
    header('Location: pageLogin.php');
    exit();
  }

  ///// Verification de la confirmation du mot de passe /////

  if($_POST['motPasse'] != $_POST['confirmeMotPasse'])
  {
    $_SESSION['motPasseNonConfirme'] = TRUE;
    $_SESSION['valeursPrecedentes'] = array();
    foreach($champs as $champ)
    {
      // on réupère les valeurs tapées sauf les mots de passes
      if(! in_array($champ,array('motPasse','confirmeMotPasse')))
      {
        $_SESSION['valeursPrecedentes'][$champ] = $_POST[$champ];
      }
    }
    // on retourne à la page login en gardant les données fournies
    // sauf le mot de passe 
    header('Location: pageLogin.php');
    exit();

  }

  ////// Vérification existance d'un même nom et prénom d'utilisateur //////

  $sqlNomPrenom = <<< END
SELECT Nom Prenom FROM utilisateur WHERE Nom=? AND Prenom=?
END;

  $verification = $conn->prepare($sqlNomPrenom);
  $verification->bind_param('ss',$_POST['nom'],$_POST['prenom']);
  $verification->execute();

  if($verification->fetch() != null)
  {
    $verification->close();
    $conn->close();
    $_SESSION['isErreur'] = TRUE;
    $_SESSION['nomExistant'] = TRUE;
    header("Location: pageLogin.php");
    exit();
  }
  $verification->close();

  ///// Verification de l'existance d'un même email dans la base de donnée ///////

  $sqlEmail = <<<END
  SELECT * FROM utilisateur WHERE Email=?;
END;

  $verification = $conn->prepare($sqlEmail);
  $verification->bind_param('s',$_POST['email']);
  $verification->execute();

  if($verification->fetch() != null)
  {
    // si déjà existant, on retourne à la page d'inscription mais en gardant les données inscrit
    $_SESSION['isErreur'] = TRUE;
    $_SESSION['emailExistant'] = TRUE;
    $_SESSION['valeursPrecedentes'] = array();
    foreach($champs as $champ)
    {
      // on réupère les valeurs tapées sauf les mots de passes et l'email
      if(! in_array($champ,array('motPasse','confirmeMotPasse','email')))
      {
        $_SESSION['valeursPrecedentes'][$champ] = $_POST[$champ];
      }
    }
    $_SESSION['valeursPrecedentes']['email'] = '';
    // on retourne à la page login en gardant les données fournies
    header('Location: pageLogin.php');
    exit();

  }

  ///// on envoie un email pour annoncer l'inscription //////

  /*
  $message = 'Vous êtes inscrit à Ecoskills';

  if(!mail('fatih_1894@hotmail.com','',$message))
  {
    // si on ne peut pas envoyer d'email, retourne à la page d'inscription
    $_SESSION['isErreur'] = TRUE;
    $_SESSION['emailNonAccessible'] = TRUE;
    $_SESSION['valeursPrecedentes'] = array();
    foreach($champs as $champ)
    {
      // on réupère les valeurs tapées sauf les mots de passes et l'email
      if(! in_array($champ,array('motPasse','confirmeMotPasse','email')))
      {
        $_SESSION['valeursPrecedentes'][$champ] = $_POST[$champ];
      }
    }
    $_SESSION['valeursPrecedentes']['email'] = '';
    // on retourne à la page login en gardant les données fournies
    header('Location: pageLogin.php');
    exit();
  }
*/
  ///// Après Vérification, on insère les données dans la base de donnée /////

  // on définit l'adresse de l'image de profile et le sauvegarde avec les données utilisateur
  // dans images/Utilisateur

  $adresseImage ="images/Utilisateur/{$_POST['nom']}_{$_POST['prenom']}";
  move_uploaded_file($_FILES['imageProfile']['tmp_name'],'../'.$adresseImage);

  // on construit la requête SQL

  $requeteSQL =<<<END
  INSERT INTO utilisateur (Nom,Prenom,DateNaissance,Email,Adresse,Localite,Commune,Sexe,AdresseImage,MotPasse) VALUES (?,?,?,?,?,?,?,?,?,?);
END;

  // on insere des données de manières sécurisé

  $instruction = $conn->prepare($requeteSQL);
    
  // les données à insérer
  $arguments = array();// les données
  $nomArguments = array('nom','prenom','dateNaissance','email','adresse','localite','commune','sexe','adresseImage','motPasse');// le nom des arguments dans $_POST
  $typeParam = '';
  foreach($nomArguments as $arg)
  {
    if($arg == 'adresseImage')
    {
      $arguments[] = $adresseImage;
    }
    else if($arg == 'motPasse')
    {
      // conserve le hash du mot de passe pour plus de sécurité
      $arguments[] = password_hash($_POST[$arg],PASSWORD_BCRYPT);
    }
    else
    {
      $arguments[] = $_POST[$arg];
    }
    $typeParam .= 's';
  }

  $instruction->bind_param($typeParam,...$arguments);
  $instruction->execute();
    
  // on vérifie si les données ont bien été insérées
  if($instruction->affected_rows < 1)// 0 ligne affecté
  {
    $_SESSION['isErreur'] = TRUE;
    $_SESSION['erreur'] = "Erreur lors de l'insertion des données dans la base de données" . $instruction->error;
    $instruction->close();
    $conn->close();
    header("Location: pageLogin.php");
    exit();
  }
    
  // on ferme les connections aux base de données
  $instruction->close();
  $conn->close();

  // on récupère les données en passant par htmlspecialchars pour 
  // éviter l'injection malveillante de code html

  $_SESSION['isErreur'] = FALSE;
  $_SESSION['nom'] = htmlspecialchars($_POST['nom']);
  $_SESSION['prenom'] = htmlspecialchars($_POST['prenom']);
  $_SESSION['sexe'] = htmlspecialchars($_POST['sexe']);
  $_SESSION['adresseImage'] = htmlspecialchars($_POST['adresseImage']);
    
}


///////////// FIN INSCRIPTION ///////////////////


//////////// CONNECTION ////////////////

else if($_POST['type']=='login')
{ 

 ///// Verification si nom et prénom existe dan la base de donnée ////

  $sqlNomPrenom =<<< END
SELECT * FROM utilisateur WHERE Nom=? AND Prenom=? ;
END;

  $verification = $conn->prepare($sqlNomPrenom);
  $verification->bind_param('ss',$_POST['nom'],$_POST['prenom']);
  $verification->execute();

  if($verification->fetch() == null)
  {
    $verification->close();
    $_SESSION['isErreur'] = TRUE;

    // on vérifie si c'est le nom, le prénom ou les deux qui sont incorrects
    
    $sqlNom =<<< END
SELECT * FROM utilisateur WHERE Nom=?;
END;
    $sqlPrenom =<<< END
SELECT * FROM utilisateur WHERE Prenom=?;
END;
    $verifNom = $conn->prepare($sqlNom);
    $verifNom->bind_param('s',$_POST['nom']);
    $verifNom->execute();

    if($verification->fetch() == null)
    {
      $_SESSION['nomNonExistant'] = TRUE;
    }

    $verifNom->close();

    $verifPrenom = $conn->prepare($sqlPrenom);
    $verifPrenom->bind_param('s',$_POST['prenom']);
    $verifPrenom->execute();

    if($verifPrenom->fetch() == null)
    {
      $_SESSION['prenomNonExistant'] = TRUE;
    }
    $verifPrenom->close();
    $conn->close();
    header('Location: pageLogin.php');
    exit();
  }

  $verification->close();

    //// Verification du mot de passe ///// 

  $sqlMotPasse = <<< END
  SELECT MotPasse FROM utilisateur WHERE Nom=? AND Prenom=? ;
END;
  
  $verifMotPasse = $conn->prepare($sqlMotPasse);
  $verifMotPasse->bind_param('ss',$_POST['nom'],$_POST['prenom']);
  $verifMotPasse->execute();

  $motPasseHash = '';
  $verifMotPasse->bind_result($motPasseHash);
  $verifMotPasse->fetch();

  
  // on vérifie si on a le bon mot de passe

  if(! password_verify($_POST['motPasse'],$motPasseHash))
  {
    $_SESSION['isErreur'] = TRUE;
    $_SESSION['mauvaisMotPasse'] = TRUE;
    $verifMotPasse->close();
    $conn->close();
    header('Location: pageLogin.php');
    exit();
  }
  $verifMotPasse->close();
  $_POST['motPasse'] = '';// on efface le mot de passe fourni par mesure de sécurité

  // après toutes les vérifications, on récupère les infos utilisateurs

  $sqlInfo =<<< END
  SELECT Nom, Prenom, Sexe, AdresseImage, Email, DateNaissance, Adresse, Commune, Localite FROM utilisateur WHERE Nom=? AND Prenom=?;
END;
  $prepareInfo = $conn->prepare($sqlInfo);
  $prepareInfo->bind_param('ss',$_POST['nom'],$_POST['prenom']);
  $prepareInfo->execute();

  $colonne = array('Prenom','Sexe','AdresseImage','Email','DateNaissance','Adresse','Commune','Localite');
  $ligne = array();

  foreach($colonne as $c)
  {
    $ligne[] = '';
  }
   $nom ='';

   $prepareInfo->bind_result($nom,...$ligne);
   $prepareInfo->fetch();

    // on récupère les données en passant par htmlspecialchars pour 
    // éviter l'injection malveillante de code html

    $_SESSION['Nom'] = htmlspecialchars($nom);
    $index = 0;
    foreach($colonne as $c)
    {
      $_SESSION[$c] = htmlspecialchars($ligne[$index]);
      $index += 1;
    }
    $prepareInfo->close();
    $conn->close();
}

///////////// FIN CONNECTION /////////////////////////////

// Que ce soit l'inscription ou login, si le programme
// arrive à ce point, alors tout c'est bien passé.
// l'utilisateur est connecté

$_SESSION['login'] = 1;
header('Location: utilisateurA.php');
exit();

?>