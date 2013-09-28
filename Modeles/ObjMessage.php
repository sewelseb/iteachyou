<?php
  class Client
    {
      private $_id;
      private $_idconversation;
      private $_titre;
      private $_texte;
      private $_date;
      private $_idEmeteur;
      private $_idDestinatere;
      
      //toutes les fonction get
      public function getId()
	{
	  return $this->_id;
	}
      public function getIdconversation()
	{
	  return $this->_idconversation;
	}
      public function getTitre()
	{
	  return $this->_titre;
	}
      public function getTexte()
	{
	  return $this->_texte;
	}
      public function getDate()
	{
	  return $this->_date;
	}
      public function getIdEmeteur()
	{
	  return $this->_idEmeteur;
	}
      public function getIdDestinatere()
	{
	  return $this->_idDestinatere;
	}
      //toutes les fonction set
      public function setId($income)
	{
	  $this->_id=$income;
	}
      public function getIdconversation($income)
	{
	  $this->_idconversation=$income;
	}
      public function getTitre($income)
	{
	  $this->_titre=$income;
	}
      public function getTexte($income)
	{
	  $this->_texte=$income;
	}
      public function getDate($income)
	{
	  $this->_date=$income;
	}
      public function getIdEmeteur($income)
	{
	  $this->_idEmeteur=$income;
	}
      public function getIdDestinatere($income)
	{
	  $this->_idDestinatere=$income;
	}
      
      //fonctions d'enregistrement dans la base de donnée
      public function envoieMessage($titre, $texte, $IdEmeteur, $IdDestinatere, $bdd)
	{
	
	  $existanceConversation=$this->existanceConversation ($IdEmeteur, $IdDestinatere, $bdd);
	  
	  
	  //si la conversation n'existe pas, on crée une nouvelle antrée dans la table conversation
	  if ($existanceConversation==0)
	    {
	      $bdd->exec('INSERT INTO conversation (id_ami_un, id_ami_deux) VALUES (\'' .$IdEmeteur. '\', \'' .$IdDestinatere. '\')');
	    }
	 
	  $idConversation=$this->idConversation ($IdEmeteur, $IdDestinatere, $bdd);
	  $date=date('j m Y H:i:s');
	  
	  //on entre le message dans la table messages
	  $bdd->exec('INSERT INTO  messages (id_conversation, titre, texte, date) VALUES (\'' .$idConversation. '\', \'' .$titre. '\', \'' .$texte. '\', \'' .$date. '\')');
	    
	
	}
      //recherche des messages recu dans la base de donnée (renvoie tout dans un array
      public function recupererMessagesRecus($Iddestinatere, $bdd)
	{
	
	}
      //recherche des messages envoyés dans la base de donnée (renvoie tout dans un array
      public function recupererMessagesEmis($Idemeteur, $bdd)
	{
	  
	}
      //tester si la conversation entre les 2 personnes existe (renvoie un booleen)
      public function existanceConversation ($idEmeteur, $idRecepteur, $bdd)
	{
	   $idConversation=$this->idConversation ($idEmeteur, $idRecepteur, $bdd);
	   
	   $retour=1;
	   
	   if($idConversation=='')
	    {
	      $retour=0;
	      
	    }
	    
	   return $retour;
	   
	}
      //recherche l'id des conversations entre deux personnes
      public function idConversation ($idEmeteur, $idRecepteur, $bdd)
	{
	  $ronflexe=$bdd->query('SELECT*FROM conversation WHERE  id_ami_un=\''.$idEmeteur.'\' AND id_ami_deux=\''.$idRecepteur.'\''); 
	  
	  while ($pikachu=$ronflexe->fetch())
	    {
	      
	      $idConversation= $client;
	      
	      
	    }
	    $ronflexe=$bdd->query('SELECT*FROM conversation WHERE  id_ami_un=\''.$idRecepteur.'\' AND id_ami_deux=\''.$idEmeteur.'\''); 
	  
	  while ($pikachu=$ronflexe->fetch())
	    {
	      
	      $idConversation= $client;
	      
	    }
	   
	  return $idConversation;
	}
	
      
    }
?>
