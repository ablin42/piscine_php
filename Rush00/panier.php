<?php
session_start();
include ("connect_db.php");

if (isset($_GET['item_id']))
{
	$count = count($_SESSION['panier']);
	for ($i = 0; $i < $count; $i++)
	{
		if ($_SESSION['panier'][$i] == $_GET['item_id'])
		{
			echo "<p style=\"text-align:center;\">ITEM WAS REMOVED FROM CART</p>";
			unset ($_SESSION['panier'][$i]);
			break;
		}
	}
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Panier</title>
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
	    				echo '<li class="nav_li" style="float:left;"><a href="admin.php" class="nav_link">Administrate</a></li>';}
	    		?>
	    		<li class="nav_li" style="float:left;"><a href="category.php?cat=0" class="nav_link">Billes</a></li>
	    		<li class="nav_li" style="float:left;"><a href="category.php?cat=1" class="nav_link">Roller</a></li>
	    		<li class="nav_li" style="float:left;"><a href="category.php?cat=2" class="nav_link">Plumes</a></li>
	    		<li class="nav_li active"><a href="panier.php" class="nav_link">Mon panier</a></li>
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
		<h1>Votre panier</h1>
		<hr />

		<?php
			if (isset($_SESSION['panier']))
			{
				foreach ($_SESSION['panier'] as $elem)
				{
					$item = mysqli_query($link, "SELECT * FROM `items` WHERE ID = '".$elem."'");
					$row = mysqli_fetch_assoc($item);
						echo "<div class=\"item_box\">
								<div class=\"item_div\">
									<a href=\"panier.php?item_id={$row['ID']}\">
									<img src=\"{$row['url']}\" alt=\"item\" class=\"item_img\"/>
									</a>
									<div class=\"item_info\">{$row['name']}</div>
								</div>
							</div>";
				}
			}
			mysqli_close($link);
		?>
		<hr />
		<a href="checkout.php"><h1>CHECKOUT</h1></a>
	</div>
	<footer>
		<p>This website was designed by @ablin and @esouza at 42 Paris - Copyright 2018</p>
		<a href="http://www.42.fr/">
			<img src="http://www.42.fr/wp-content/themes/42/images/42_logo_black.svg" alt="42logo" style="width: 50px;"/>
		</a>
	</footer>
</body>
</html>