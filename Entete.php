<?php

$enTete = <<< _END
        <div id="EnTete">
        
            <a href="index.php" target="_self"><img src="images/LogoEcoSkill.jpg" alt="Logo" title="Page d'acceuil"></a>
          
            <form action="index.php" method="POST">
                <input type="text" value="mots clés">
                <input type="submit" value="Recherche">
            </form>

            <a id="accueilDroite" href="index.php" target="_self"><img src="images/LogoPageAccueil.png" alt="Page d'Accueil" title="Page d'acceuil"></a>
            <a id="compte" href="Utilisateur/utilisateurA.php" target="_self" ><img src="images/LogoUtilisateur.jpg" alt="MonCompte" title="Mon compte"></a>

        </div>
_END;
?>