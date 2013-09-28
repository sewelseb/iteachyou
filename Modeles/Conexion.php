<?php
  
  include ('conexionBDD.php');
  include ('ObjClient.php');
  
  //récupération des POST
  $motDePasseRecu=$_POST['MotDePasse'];
  $pseudoRessu=$_POST['Pseudo'];
  
   //instanciation du client
   $client= new Client();
  
  //recherche du mot de passe à prtir du pseudo dans la bdd
  $motDePasseBDD=$client->rechercheMotDePasseParPseudo($pseudoRessu, $bdd);
  
  //comparaison des deux mdp et mise en place du syteme de sécurité
  if ($motDePasseBDD==$motDePasseRecu)
    {
      $clef=$client->aleatoireExa();
      $client->EnregistrerClef($pseudoRessu, $clef, $bdd);
      $client->ClefCookie($clef, $pseudoRessu);
      header ('location: index.php?page=home');
      
    }
   else
    {
      header ('location: index.php?page="tasdemorve"');
    }
    
?>
