<?php
  class Client
    {
      private $_id;
      private $_pseudo;
      private $_motDePasse;
      private $_motDePasseBDD;
      private $_clefExa;
      
      public function getId()
	{
	  return $this->_id;
	}
      public function getPseudo()
	{
	  return $this->_pseudo;
	  
	}
      public function getMotDePasse()
	{
	  return $this->_motDePasse;
	}
      public function getClefExa()
	{
	  return $this->_clefExa;
	}
      public function postPseudo($pseudo)
	{
	  
	  $this->_pseudo=$pseudo;
	  
	}
      public function postMotDePasse($motDePasse)
	{
	  $this->_motDePasse=$motDePasse;
	}
      public function inscription_enregistrement ()
	{
	
	}
      public function addDB($bdd)   // insere le pseudo et le mot de passe dans la base de donnée (nouvelle entrée)
	{
	  $pseudo=$this->getPseudo();
	  $mdp=$this->getMotDePasse();
	  //$q=$this->_db->prepare('INSERT INTO clients SET pseudo=:pseudo, motdepasse=:motdepasse');
	  //$q=binValue(':nom',$this->getPseudo());
	  //$q=binValue(':motdepasse',$this->getMotDePasse());
	  //$q->execute();
	  $bdd->exec('INSERT INTO clients (pseudo, motdepasse) VALUES (\'' .$pseudo. '\', \'' .$mdp. '\')');
	 
	}
      public function rechercheMotDePasseParPseudo($pseudo, $bdd)   //recherche du mot de passe associé à $pseudo dans la base de donnée
	{
	  
	  $ronflexe=$bdd->query('SELECT*FROM clients WHERE pseudo=\''.$pseudo.'\''); 
	  while ($pikachu=$ronflexe->fetch())
	    {
	      $_motDePasseBDD=$pikachu ['motdepasse'];
	    }
	    
	   return $_motDePasseBDD;
	}
      public function aleatoireExa()   //tire un nombre aléatoire en hexa décimale baé sur l'instant (ne jamais le considérer comme unique)
	{
	  $nombreAleatoire=time();
	  $nombreAleatoire=hexdec($nombreAleatoire);
	  
	  return $nombreAleatoire;
	  
	}
      public function EnregistrerClef($pseudo, $clef, $bdd) //enregistre la clef dans la base de donnée
	{
	  $bdd->exec('UPDATE clients SET clef=\''.$clef. '\' WHERE pseudo=\''.$pseudo. '\'');
	}
      public function ClefCookie ($clef, $pseudo) //instale les cookies
	{
	  setcookie ('pseudo', $pseudo, time() + 3600*5, null, null, false, true);
	  setcookie ('clef', $clef, time() + 3600*5, null, null, false, true);
	}
      public function getClefBDD($pseudo, $bdd)  //recherche la clef de securité (correspondant au $pseudo) dans la base de donnée
	{
	  $ronflexe=$bdd->query('SELECT*FROM clients WHERE pseudo=\''.$pseudo.'\''); 
	  while ($pikachu=$ronflexe->fetch())
	    {
	      return $pikachu ['clef'];
	    }
	    
	   
	}
      public function getIDBDD($pseudo, $bdd)   //recherche l'id dans la base de donnée à partir du pseudo
	{
	  $ronflexe=$bdd->query('SELECT*FROM clients WHERE pseudo=\''.$pseudo.'\''); 
	  while ($pikachu=$ronflexe->fetch())
	    {
	      return $pikachu ['ID'];
	    }
	    
	   
	}
      public function verificationConecte($pseudo, $clefCOOKIE, $bdd) //retourne un booleen
	{
	  $clefBDD=$this->getClefBDD($pseudo, $bdd);
	  
	  if ($clefCOOKIE==$clefBDD)
	    {
	      return 1;
	    }
	   else
	    {
	      return 0;
	    }
	}
      public function rechercheParPseudo ($pseudo, $bdd) //retourne un tableau avec tous les membres qui ont ce pseudo
	{
	  $ronflexe=$bdd->query('SELECT*FROM clients WHERE pseudo=\''.$pseudo.'\''); 
	  
	  $zarbi=0;
	  while ($pikachu=$ronflexe->fetch())
	    {
	      $client= array ('ID'=>$pikachu['ID'], 'pseudo'=>$pikachu['pseudo'], 'nom'=>$pikachu['nom'], 'prenom'=>$pikachu['prenom'], 'date_naissance'=>$pikachu['date_naissance'], 'photo'=>$pikachu['photo'], 'description'=>$pikachu['description']);
	      $resultat[$zarbi]= $client;
	      $zarbi=$zarbi+1;
	    }
	    return $resultat;
	}
      public function creerLienAmitié($clientSoisMeme, $clientAmis, $bdd)  //crée un lien d'amitié entre deux personnes
	{
	  $id_ami_un = getIDBDD($clientSoisMeme, $bdd);
	  $id_ami_deux = getIDBDD($clientAmis, $bdd);
	  $bdd->exec('INSERT INTO amitie (id_ami_un, id_ami_deux, confirmer_ami_un, confirmer_ami_deux) VALUES (\'' .$id_ami_un. '\', \'' .$id_ami_deux. ', 1, 0\')');
	  $bdd->exec('INSERT INTO amitie (id_ami_un, id_ami_deux, confirmer_ami_un, confirmer_ami_deux) VALUES (\'' .$id_ami_deux. '\', \'' .$id_ami_un. ', 0, 1\')');
	}
      public function liensAmitié($monID, $bdd) //retourne les ID des amis
	{
	  $ronflexe=$bdd->query('SELECT*FROM amitie WHERE  id_ami_un=\''.$monID.'\' AND confirmer_ami_un=\'1\' AND confirmer_ami_deux=\'1\''); 
	  $zarbi=0;
	  while ($pikachu=$ronflexe->fetch())
	    {
	      $client= $pikachu['id_ami_deux'];
	      $resultat[$zarbi]= $client;
	      $zarbi=$zarbi+1;
	    }
	    return $resultat;
	}
      public function listeMesAmis($monPseudo, $bdd) //selectionne tous les id des amis et les mets dans un array
	{
	  $monID=getIDBDD($monPseudo, $bdd);
	  $listeAmis=liensAmitié($monID, $bdd);
	  
	  return $listeAmis;
	  
	}
      public function infosAmis ($listeAmis, $bdd)  //infos sur les nom dans l'array $listeAmis qu'il renvoie dans un array
	{
	  foreach ($listeAmis as $metamorphe)
	    {
	      $ronflexe=$bdd->query('SELECT*FROM clients WHERE ID=\''.$metamorphe.'\''); 
	      
	      $zarbi=0;
	      while ($pikachu=$ronflexe->fetch())
		{
		  $client= array ('ID'=>$pikachu['ID'], 'pseudo'=>$pikachu['pseudo'], 'nom'=>$pikachu['nom'], 'prenom'=>$pikachu['prenom'], 'date_naissance'=>$pikachu['date_naissance'], 'photo'=>$pikachu['photo'], 'description'=>$pikachu['description']);
		  $resultat[$zarbi]= $client;
		  $zarbi=$zarbi+1;
		}
	    }
	    
	   return $resultat;
	}
	
	
    }
?>
