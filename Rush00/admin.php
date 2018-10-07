<?php
session_start();
if (isset($_SESSION['auth']) && $_SESSION['auth'] != 1)
	header ("Location: index.php");	
else
{
	include ("connect_db.php");
	$users = mysqli_query($link, "SELECT * FROM `users`"); 
	$items = mysqli_query($link, "SELECT * FROM `items`"); 
	mysqli_close($link);
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Admin</title>
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
		<div class="users_div">
			<h2>SUPPRIMER UN UTILISATEUR</h2>
			<?php
				while ($row = mysqli_fetch_assoc($users))
   				{
   					echo "<div class=\"holder\"><a style=\"color:red; float:left;\" href=\"delete_user.php?user_id={$row['ID']}\">X</a><span class=\"user_span\">{$row['login']}</span></div>";
    			}
			?>
		</div>
		<div class="items_div">
			<h2>SUPPRIMER UN ITEM</h2>
			<?php
				while ($row = mysqli_fetch_assoc($items))
   				{
   					echo "<div class=\"holder\"><a style=\"color:red; float:left;\" href=\"delete_item.php?item_id={$row['ID']}\">X</a><span class=\"item_span\">{$row['name']}</span></div>";
    			}
			?>
		</div>
		<a href="add.php"><h2>AJOUTER DES ITEMS</h2></a>
	</div>
	<footer>
		<p>This website was designed by @ablin and @esouza at 42 Paris - Copyright 2018</p>
		<a href="http://www.42.fr/">
			<img src="http://www.42.fr/wp-content/themes/42/images/42_logo_black.svg" alt="42logo" style="width: 50px;"/>
		</a>
	</footer>
</body>
</html>