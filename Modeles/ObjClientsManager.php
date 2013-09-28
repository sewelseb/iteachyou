<?php
  class ClientsManager
    {
      private $_db; //instance de PDO
      
      
      public function __construct($db)
	{
	  $this->setDb($db);
	}
      public function addDB(Client $Client)
	{
	  $q=$this->_db->prepare('INSERT INTO clients SET pseudo=:pseudo, motdepasse=:motdepasse');
	  $q=binValue(':nom',$Client->getPseudo());
	  $q=binValue(':motdepasse',$Client->getMotDePasse());
	  $q->execute();
	}
      public function count()
	{
	  //comptage du nombre de membre
	  return $this->_db->query('SELECT COUNT * FROM clients')->fetchColumn();
	}
      public function delete()
	{
	  
	}
      public function exists($info)
	{
	  //si parametre est entier=>Id=>requete count avec un where et on retourne un booleen
	  //sinon=>pseudo=>requete count avec un where et on retourne un booleen
	}
      public function get($info)
	{
	  //si parametre est entier=>Id=>
	  //sinon=>pseudo=>
	}
       public function update($info)
	{
	  
	}
       public function setDb(PDO $db)
	{
	  $this->_db=$db;
	}
    }
?> 
