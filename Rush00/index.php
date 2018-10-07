<?php
session_start(); 
?>
<!DOCTYPE HTML>
<title>Random site</title>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
   </head>

<body>
	<header>
        <nav class="navbar" id="top" role="navigation">
	    	<ul class="nav_ul">
	    		<li class="nav_li active" style="float: left;"><a href="index.php" class="nav_link">Home</a></li>
	    		<?php 
	    			if ($_SESSION['login'] != "" ) { 
	    				echo '<li class="nav_li" style="float:left;"><a href="panier.php" class="nav_link">';
	    				echo $_SESSION['login'];
	    				echo "</a></li>";}
	    		?>
	    		<li class="nav_li"><a href="panier.php" class="nav_link">Mon panier</a></li>
	    		<?php 
	    			if ($_SESSION['login'] == "" ) { 
	    				echo '<li class="nav_li"><a href="connexion.php" class="nav_link">Se connecter</a></li>';}
	    		?>
	    		<?php 
	    			if ($_SESSION['login'] == "" ) { 
	    				echo '<li class="nav_li"><a href="inscription.php" class="nav_link">S\'inscrire</a></li>';}
	    		?>
	    		<?php 
	    			if ($_SESSION['login'] != "" ) { 
	    				echo '<li class="nav_li"><a href="logout.php" class="nav_link">Se déconnecter</a></li>';}
	    		?>
	    	</ul>
        </nav>
	</header>
	<div class="main_wrapper">
		<div class="row">
		<div class="item_box">
			<div class="item_div">
				<a href="#"><img src="https://bruneau.media/OMM/Images_Basse_Definition/ZoomHD/39/20/39205.jpg?width=1200&height=1200&mode=Default&quality=85&scale=upscalecanvas" alt="item" class="item_img"/></a>
				<div class="item_info">some shiny pen</div>
			</div>
		</div>
		<div class="item_box">
			<div class="item_div">
				<a href="#"><img src="https://bruneau.media/OMM/Images_Basse_Definition/ZoomHD/39/20/39205.jpg?width=1200&height=1200&mode=Default&quality=85&scale=upscalecanvas" alt="item" class="item_img"/></a>
				<div class="item_info">some shiny pen</div>
			</div>
		</div>
		<div class="item_box">
			<div class="item_div">
				<a href="#"><img src="https://bruneau.media/OMM/Images_Basse_Definition/ZoomHD/39/20/39205.jpg?width=1200&height=1200&mode=Default&quality=85&scale=upscalecanvas" alt="item" class="item_img"/></a>
				<div class="item_info">some shiny pen</div>
			</div>
		</div>
		<div class="item_box">
			<div class="item_div">
				<a href="#"><img src="https://bruneau.media/OMM/Images_Basse_Definition/ZoomHD/39/20/39205.jpg?width=1200&height=1200&mode=Default&quality=85&scale=upscalecanvas" alt="item" class="item_img"/></a>
				<div class="item_info">some shiny pen</div>
			</div>
		</div>
		</div>
		<div class="row">
		<div class="item_box">
			<div class="item_div">
				<a href="#"><img src="https://bruneau.media/OMM/Images_Basse_Definition/ZoomHD/39/20/39205.jpg?width=1200&height=1200&mode=Default&quality=85&scale=upscalecanvas" alt="item" class="item_img"/></a>
				<div class="item_info">some shiny pen</div>
			</div>
		</div>
		<div class="item_box">
			<div class="item_div">
				<a href="#"><img src="https://bruneau.media/OMM/Images_Basse_Definition/ZoomHD/39/20/39205.jpg?width=1200&height=1200&mode=Default&quality=85&scale=upscalecanvas" alt="item" class="item_img"/></a>
				<div class="item_info">some shiny pen</div>
			</div>
		</div>
		<div class="item_box">
			<div class="item_div">
				<a href="#"><img src="https://bruneau.media/OMM/Images_Basse_Definition/ZoomHD/39/20/39205.jpg?width=1200&height=1200&mode=Default&quality=85&scale=upscalecanvas" alt="item" class="item_img"/></a>
				<div class="item_info">some shiny pen</div>
			</div>
		</div>
		<div class="item_box">
			<div class="item_div">
				<a href="#"><img src="https://bruneau.media/OMM/Images_Basse_Definition/ZoomHD/39/20/39205.jpg?width=1200&height=1200&mode=Default&quality=85&scale=upscalecanvas" alt="item" class="item_img"/></a>
				<div class="item_info">some shiny pen</div>
			</div>
		</div>
		</div>
	</div>
	<footer>
		<p>This website was designed by @ablin and @esouza at 42 Paris - Copyright 2018</p>
		<a href="http://www.42.fr/">
			<img src="http://www.42.fr/wp-content/themes/42/images/42_logo_black.svg" alt="42logo" style="width: 50px;"/>
		</a>
	</footer>
</body>
</html>