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

	<!-- FORMULAIRE -->
	<div id="portfolio2">
		<div id="accueil">
			<span class="arrow-down"></span>
		</div>

		<div class="title">
			<h2>La salle de <span>classe</span></h2>
			<p>Vous souhaitez rejoindre une salle existante</p>
			<div class="content"><form name="creationClasse" method="POST" action="index.php?page=classe">
				Votre nom: 
				<input type="text" autofocus required name="username" />
				Password:
				<input type="password" name="password" />
				<?php echo '<input type=hidden name=meetingId value="'.$_GET['meetingId'].'">';?>
				<input type=hidden name=action value="rejoindre"><br /><input class="button-submit" type="submit" value="Rejoindre la salle" />				
			</form>
			</div>
			<p>Ce nom sera celui sous lequel vous serez connu au sein de la classe virtuelle. </p>
		</div>
	</div>
</div>
<div id="copyright">
	<p>Copyright (c) 2013 Sitename.com. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://www.freecsstemplates.org/" rel="nofollow">FreeCSSTemplates.org</a>.</p>
</div>
</body>
</html>