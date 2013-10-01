<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IteachYou BETA</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800|Open+Sans+Condensed:300,700" rel="stylesheet" />
    <link href="Vues/css/JustifiableCSS/default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="Vues/css/JustifiableCSS/fonts.css" rel="stylesheet" type="text/css" media="all" />
    <!-- zoombox -->


    <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

  </head>
  <body>
  <div id="logo" class="container">
	  <h1><span class="icon icon-comments-alt icon-size"></span><a href="index.html">I<span>teach</span>You</a></h1>
	  
	  <p>Version Beta // Work in progress</p>
  </div>
	<div id="wrapper" class="container">
		<!-- MENU-->
		<div id="menu" class="container">
		  <ul>
			  <li><a href="#description_iteachyou" accesskey="1" title="">IteachYou</a></li>
			  <li><a href="#pourquoi_valeurs" accesskey="2" title="">FAQ</a></li>
			  <li><a href="#nous" accesskey="3" title="">L'équipe</a></li>
			  <li><a href="#contact" accesskey="4" title="">Contact</a></li>
			  <!--<li><a href="">Votre avis</a></li>-->
		  </ul>
		</div>
		
		
		<div id="three-column" class="container">
		<div id="accueil">
			<span class="arrow-down"></span>
		</div>
		 <div class="title">
			  <h2>La <span>classe</span> virtuelle</h2>
			  <span class="byline">Vous trouverez ci-dessous la liste des classes Virtuelles actives en ce moment. Alternativement, vous pouvez en créer une!</span><br />
		  </div>
<?php
	if(isset($meetingsIdArray)){
		for ($i=0; $i<count($meetingsIdArray); $i++){		
		
			echo '<div id="tbox1">
			<h3>'.$meetingsIdArray[$i].'</h3>';
			for($j=0; $j<count($utilisateur); $j++){
				echo $utilisateur[$i][$j]["fullName"].'    '.$utilisateur[$i][$j]["role"].'<br />';
			}
			echo '<a href="/index.php?page=rejoindreClasse&meetingId='.$meetingsIdArray[$i].'" class="button">Rejoindre!</a>';
			echo'</div>';
		}
	}
	else{
		echo"<p>Il n'y a pas de salles actives en ce moment... Mais vous pouvez en créer une!</p>";
		}
?>		
		<a href="/index.php?page=creationClasse" class="button">Créer une classe!</a>
		</div>
		
		
	</div>
</body>
</html>