<?php
  include ('conexionBDD.php');
  include ('ObjClient.php');
  
  //instanciation du client
  $client= new Client();
  
  //vérification de conexion
  $pseudoCOOKIE= $_COOKIE['pseudo'];
  $clefCOOKIE= $_COOKIE['clef'];
  
  $clefBDD=$client->verificationConecte($pseudoCOOKIE, $clefCOOKIE, $bdd);
  
  if ($clefBDD==0)
    {
      header ('location: index.php?page=tasdemorve');
    }
?>
