<?php

session_start(); 
if (!$_SESSION['login'])
	header ("Location: index.php");
else
{
	include ("connect_db.php");
   	$login = $_SESSION['login'];

   	if ($res = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '".$login."'"))
   	{
   		while ($row = mysqli_fetch_assoc($res))
   		{
   			$address = $row['address'];
   			$password = $row['password'];
        }
    }
    if (isset($_POST['address']) && !empty($_POST['address']) && isset($_POST['oldpasswd']) && !empty($_POST['oldpasswd']) && isset($_POST['passwd']) && !empty($_POST['passwd']))
    {
    	$oldpasswd = hash(whirlpool, mysqli_real_escape_string($link, $_POST['oldpasswd']));
    	$newaddress = mysqli_real_escape_string($link, $_POST['address']);
    	$newpasswd = hash(whirlpool, mysqli_real_escape_string($link, $_POST['passwd']));

    	if ($oldpasswd === $password)
    		$res = mysqli_query($link, "UPDATE `users` SET `password` = '".$newpasswd."',  `address` = '".$newaddress."' 
    		WHERE `login` = '".$login."'");
    }
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
	    				echo '<li class="nav_li active" style="float:left;"><a href="account.php" class="nav_link">';
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
		<?php 
			if ($_SESSION['login'] != "") 
			{
				echo "<h2 style=\"text-align:center;\">Modifiez vos informations</h2>";
				echo "<h3 style=\"text-align:center;\">";
				echo $_SESSION['login'];
				echo "</h3>";
			}
		?>
		<div class="form_div">
			<form action="account.php" method="post">
				Address: <input type="text" name="address" value="<?php if (isset($address)) echo $address; ?>" required/>
				<br />
				Mot de passe: <input type="password" name="oldpasswd" value="" required/>
				<br />
				Nouveau mot de passe: <input type="password" name="passwd" placeholder="Password" value="" required/>
				<br />
				Confirmez le mot de passe: <input type="password" name="passwd2" placeholder="Confirm Password" value="" required/>
				<input type="submit" value="Enregistrer" name="submit" />
			</form>
		</div>
		<div class="form_div">
			<h1>ATTENTION CETTE ACTION EST IRREVERSIBLE</h1>
 			<a href="delete.php" class="delButton">SUPPRIMER MON COMPTE</a>
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