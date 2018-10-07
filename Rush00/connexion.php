<?php
session_start(); 
if (isset($_SESSION['login']) && !empty($_SESSION['login']))
	header ("Location: index.php");	
if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['passwd']) && $_POST['submit'] === "OK" && $_POST['login'] !== "" && $_POST['passwd'] !== "")
{
	include ("connect_db.php");
	$login = mysqli_real_escape_string($link, $_POST['login']);
	$passwd = mysqli_real_escape_string($link, $_POST['passwd']);
	$passwd = hash(whirlpool, $passwd);

	$res = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '".$login."' AND `password` = '".$passwd."'");
	if (mysqli_num_rows($res) >= 1)
	{
		$row = mysqli_fetch_assoc($res);
   			$_SESSION['auth'] = $row['auth'];
		$_SESSION['login'] = $login;
		header ("Location: index.php");
	}
	else
		echo "<p style=\"text-align:center;\">Le mot de passe et le nom de compte ne match pas</p>";
	mysqli_close($link);
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion</title>
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
	    		<li class="nav_li"><a href="panier.php" class="nav_link">Mon panier</a></li>
	    		<?php 
	    			if ($_SESSION['login'] == "" ) { 
	    				echo '<li class="nav_li active"><a href="connexion.php" class="nav_link">Se connecter</a></li>';}
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
			<div class="form_hold">
			<form action="connexion.php" method="post">
				Identifiant: <input type="text" name="login" value="" required/>
				<br />
				Mot de passe: <input type="password" name="passwd" value="" required/>
				<input type="submit" value="OK" name="submit" />
			</form>
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