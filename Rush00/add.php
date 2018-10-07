<?php
session_start();
if (isset($_SESSION['auth']) && $_SESSION['auth'] != 1)
	header ("Location: index.php");	
else
{
	if (isset($_POST["submit"]) && !empty($_POST["submit"]) && isset($_POST["name"]) && !empty($_POST["name"]) 
		&& isset($_POST["url"]) && !empty($_POST["url"]) && isset($_POST["prix"]) && !empty($_POST["prix"]) 
		&& isset($_POST['category']) && !empty($_POST["category"]))
	{
		include ("connect_db.php");
	   	$name = mysqli_real_escape_string($link, $_POST['name']);
		$prix = mysqli_real_escape_string($link, $_POST['prix']);
		$category = mysqli_real_escape_string($link, $_POST['category']);
		$url = mysqli_real_escape_string($link, $_POST['url']);
		mysqli_query($link, "INSERT INTO `items` (`name`, `prix`, `category`, `url`) 
							VALUES ('".$name."', '".$prix."', '".$category."', '".$url."')"); 
		mysqli_close($link);
	}
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Ajouter un item</title>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
   </head>
   
<body>
	<header>
        <nav class="navbar" id="top" role="navigation">
	    	<ul class="nav_ul">
	    		<li class="nav_li" style="float: left;"><a href="index.php" class="nav_link">Home</a></li>
	    		<?php 
	    			if ($_SESSION['login'] != "" ) { 
	    				echo '<li class="nav_li" style="float:left;"><a href="account.php" class="nav_link">';
	    				echo $_SESSION['login'];
	    				echo "</a></li>";}
	    			if ($_SESSION['auth'] == 1){
	    				echo '<li class="nav_li active" style="float:left;"><a href="admin.php" class="nav_link">Administrate</a></li>';}
	    		?>
	    		<li class="nav_li" style="float:left;"><a href="category.php?cat=0" class="nav_link">Billes</a></li>
	    		<li class="nav_li" style="float:left;"><a href="category.php?cat=1" class="nav_link">Roller</a></li>
	    		<li class="nav_li" style="float:left;"><a href="category.php?cat=2" class="nav_link">Plumes</a></li>
	    		<li class="nav_li"><a href="panier.php" class="nav_link">Mon panier</a></li>
	    		<?php 
	    			if ($_SESSION['login'] == "" ) { 
	    				echo '<li class="nav_li"><a href="connexion.php" class="nav_link">Se connecter</a></li>';}
	    			if ($_SESSION['login'] == "" ) { 
	    				echo '<li class="nav_li"><a href="inscription.php" class="nav_link">S\'inscrire</a></li>';}
	    			if ($_SESSION['login'] != "" ) { 
	    				echo '<li class="nav_li"><a href="logout.php" class="nav_link">Se déconnecter</a></li>';}
	    		?>
	    	</ul>
        </nav>
	</header>
	<div class="main_wrapper">
		<div class="form_div">
		<form action="add.php" method="post" id="formadd">
			Nom de l'item: <input type="text" name="name" value="" required/>
			<br />
			Prix <input type="text" name="prix" value="" required/>
			<br />
			Category: 	<select name="category" form="formadd">
 					 		<option value="0">Plume</option>
						 	<option value="1">Bille</option>
						 	<option value="2">Roller</option>
						</select>
			<br />
			URL de l'image: <input type="text" name="url" value="" required/>
			<br />
			<input type="submit" value="ADD" name="submit" />
		</form>
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
