<?php

session_start();

$servername = "localhost";
$username = "fatih";
$password = "12345";
$BD ="ecoSkillBD";

// on réinitialise les variables d'erreurs

$_SESSION['isErreur'] = FALSE;
$_SESSION['nomExistant'] = FALSE;
$_SESSION['nomNonExistant'] = FALSE;
$_SESSION['prenomNonExistant'] = FALSE;

// Create connection
$conn = mysqli_connect($servername, $username, $password,$BD);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


// si on a une demande d'inscription
if($_POST['type']=='inscription')
{
  // on vérifie si le nom et prénom existe déjà
  $sqlNomPrenom = <<< END
  SELECT Nom Prenom FROM utilisateur WHERE Nom="{$_POST["nom"]}" AND Prenom="{$_POST["prenom"]}";
END;

  $checkNom = $conn->query($sqlNomPrenom);
  if(mysqli_num_rows($checkNom) != 0)
  {
    // si déjà existant, on retourne à la page d'inscription
    $_SESSION['isErreur'] = TRUE;
    $_SESSION['nomExistant'] = TRUE;
    header("Location: pageLogin.php");
    exit();
  }
  else
  {
    // sinon
    $_SESSION['nomExistant'] = FALSE;
    $_SESSION['isErreur'] = FALSE;

    // on définit l'adresse de l'image de profile et le sauvegarde avec les données utilisateur
    $adresseImage ="images/Utilisateur/{$_POST['nom']}_{$_POST['prenom']}";
    move_uploaded_file($_FILES['imageProfile']['tmp_name'],'../'.$adresseImage);

    // on définit les infos à stocker dans la base de données
    $requeteSQL =<<<END
    INSERT INTO utilisateur (Nom,Prenom,Age,Sexe,AdresseImage) VALUES ('{$_POST['nom']}','{$_POST['prenom']}','{$_POST['age']}','{$_POST['sexe']}','$adresseImage');
END;

    // on vérifie si les données ont bien été insérées
    if(!$conn->query($requeteSQL))
    {
      $_SESSION['isErreur'] = TRUE;
      $_SESSION['erreur'] = "Erreur lors de l'insertion des données dans la base de données";
      header("Location: pageLogin.php");
      exit();
    }
    else
    {
      $_SESSION['isErreur'] = FALSE;
      $_SESSION['nom'] = $_POST['nom'];
      $_SESSION['prenom'] = $_POST['prenom'];
      $_SESSION['age'] = $_POST['age'];
      $_SESSION['sexe'] = $_POST['sexe'];
      $_SESSION['adresseImage'] = $adresseImage;
    }
  }
}
// si on a une demande de connection
else if($_POST['type']=='login')
{ 
  // on récupère les info de la base de données
  $sqlNomPrenom =<<< END
SELECT * FROM utilisateur WHERE Nom="{$_POST['nom']}" AND Prenom="{$_POST['prenom']}";
END;

$donnees = $conn->query($sqlNomPrenom);

// on vérifie si le nom et prénom existe dans la base de donnée
  if(mysqli_num_rows($donnees) == 0)
  {
    $_SESSION['isErreur'] = TRUE;
    // on vérifie si c'est le nom, le prénom ou les deux qui sont incorrects
    $sqlNom =<<< END
SELECT * FROM utilisateur WHERE Nom="{$_POST['nom']}";
END;
    $sqlPrenom =<<< END
SELECT * FROM utilisateur WHERE Prenom="{$_POST['prenom']}";
END;
    if(mysqli_num_rows($conn->query($sqlNom)) == 0)
    {
      $_SESSION['nomNonExistant'] = TRUE;
    }
    else
    {
      $_SESSION['nomNonExistant'] = FALSE;
    }
    if(mysqli_num_rows($conn->query($sqlPrenom)) == 0)
    {
      $_SESSION['prenomNonExistant'] = TRUE;
    }
    else
    {
      $_SESSION['prenomNonExistant'] = FALSE;
    }
    header('Location: pageLogin.php');
    exit();
  }
  else
  {
    $_SESSION['nomExistanceErreur'] = FALSE;
    // on récupère les données
    $ligne = $donnees->fetch_array(MYSQLI_ASSOC);
    $_SESSION['nom'] = $ligne['Nom'];
    $_SESSION['prenom'] = $ligne['Prenom'];
    $_SESSION['age'] = $ligne['Age'];
    $_SESSION['sexe'] = $ligne['Sexe'];
    $_SESSION['adresseImage'] = $ligne['AdresseImage'];
    
  }

}

$_SESSION['login'] = 1;
header('Location: utilisateurA.php');
exit();

?>