<?php
  include ('conexionBDD.php');
  include ('ObjClient.php');
  
  //instanciation du client
  $client= new Client();
  
  $pseudo=$_POST['pseudoAmi']; //faire le form qui permet la recherche
  
  //recherche par pseudo
  $amisPotentiels=$client->rechercheParPseudo ($pseudo, $bdd) //le resultat est un double arraycontenant en premier les clients trouvés et en 2em, les propriétés de ces membres
  
 
?>
