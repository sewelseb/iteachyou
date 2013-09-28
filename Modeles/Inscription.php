<?php
  $test='a';
  
  $pseudo=$_POST['Pseudo'];
  $motdepasse=$_POST['MotDePasse'];
 
  
  
  
  
  include ('Modeles/ObjClient.php');
  include ('Modeles/ObjClientsManager.php');
  include ('Modeles/conexionBDD.php');
  
  $Client= new Client();
  
  $Client->postPseudo($pseudo);
  
  $test=$Client->getPseudo();
  
  
  $Client->postMotDePasse($motdepasse);
  $test=$Client->getMotDePasse();
  echo ($test);
  $Client->addDB($bdd);
  
  //$manager= new ClientsManager($db);
  //$manager->add($Client);
  echo ($test);
  
  header ('location: index.php?page=bourgPalet');
  
?>
