<?php 
  //FrontControler 
?>

<?php
  session_start(); //démarage de la cession
  
  //include('conexionBDD.php'); //conexion à la base de donnée
  
  ob_start(); //initialisation du tampon=> tout le code html va dedant et ressortira lorsque on mettra la fonction ob_end_flush()
  //include('vues/header.php'); //inclusion du header
  
  if (!empty($_GET['page']) && is_file('Controleurs/'.$_GET['page'].'.php'))
    {
      include ('Controleurs/'.$_GET['page'].'.php');
      
    }
  else
    {
      
      include ('Controleurs/Accueil.php');
    }
   
   //include('vues/footer.php'); //inclusion du pied de page
   
   ob_end_flush(); //affichage du code html et autre
   //mysql_close(); //fermeture de la conexion au serveur mysql
 ?>