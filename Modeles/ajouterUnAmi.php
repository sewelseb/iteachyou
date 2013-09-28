<?php
  include ('conexionBDD.php');
  include ('ObjClient.php');
  
  //instanciation du client
  $client= new Client();
  
  $clientSoisMeme = $_COOKIE['pseudo'];
  $clientAmis=$_POST['ajouterAmi'];
  
  $client->creerLienAmitié($clientSoisMeme, $clientAmis, $bdd);
  
  header('locatio: index.php?page=home');

?>
