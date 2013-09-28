<?php
  include ('conexionBDD.php');
  include ('ObjClient.php');
  
  //instanciation du client
  $client= new Client();
  
  //récupération des Cookies
  $pseudoCOOKIE= $_COOKIE['pseudo'];
  $clefCOOKIE= $_COOKIE['clef'];
  
  $client->EnregistrerClef($pseudoCOOKIE, '', $bdd);
  $client->ClefCookie ('', ''); //on vide les cookies
  
  header('location: index.php?page=bourgpalais');
?>
