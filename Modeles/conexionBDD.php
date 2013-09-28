 <?php
  try
    {
      //mysql_connect('localhost', 'root', 'genevieve');
      //mysql_select_db('iteachyou');
      //$db=new PDO('mysql:host=localhost;dbname=iteachyou','root','genevieve');
      //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); //emet une alerte chaque fois qu'une requete n'a pas marchés
      $bdd= new PDO('mysql:host=localhost;dbname=iteachyou', 'root', 'genevieve');
      array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    }
  catch (Exception $e)
    {
      die ('Erreur: '.$e->getMessage());
    }
 ?>
