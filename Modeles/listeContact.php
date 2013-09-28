<?php
  include ('conexionBDD.php');
  include ('ObjClient.php');
  
  $pseudo=$_COOKIE['pseudo'];
  
  
  //instanciation du client
  $client= new Client();
  
  //recherche et mise en array des amis:
  $listeAmis=$client->listeAmis($pseudo, $bdd);
  $listeInfoAmis=$clientinfosAmis ($listeAmis, $bdd); //il s'agit bien d'un array exploitable avec un foreach
?>
