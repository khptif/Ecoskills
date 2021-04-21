<?php
session_start();


// permet d'être redirigé vers la page login si pas connecté
$adresseMonCompte='';

if(isset($_SESSION['login']))
{
    if($_SESSION['login']==1)
    {
        $adresseMonCompte = 'Utilisateur/utilisateurA.php';
    }
}
else
{
    $adresseMonCompte = 'Utilisateur/pageLogin.php';
}

$enTete = <<< _END
        <div id="EnTete">
        
            <a href="index.php" target="_self"><img src="images/EcoskillsLogo.png" alt="Logo" title="Page d'acceuil"></a>
          
            <form action="index.php" method="POST">
                <input type="text" value="mots clés">
                <input type="submit" value="Recherche">
            </form>

            <a id="accueilDroite" href="index.php" target="_self"><img src="images/LogoPageAccueil.png" alt="Page d'Accueil" title="Page d'acceuil"></a>
            <a id="compte" href="$adresseMonCompte" target="_self" ><img src="images/LogoUtilisateur.jpg" alt="MonCompte" title="Mon compte"></a>
           

        </div>
_END;
?>