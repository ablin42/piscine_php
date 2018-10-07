<?php
session_start(); 

if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['passwd']) && $_POST['submit'] === "OK" && $_POST['login'] !== "" && $_POST['passwd'] !== "")
{
	$arr['login'] = $_POST['login'];
	$arr['passwd'] = hash("whirlpool", $_POST['passwd']);
	$file = "private/passwd";
	$tab = unserialize(file_get_contents($file));
	foreach ($tab as $key => $val)
	{
		if ($val['login'] === $arr['login'] && $val['passwd'] === $arr['passwd'])
		{
			$_SESSION['login'] = $arr['login'];
			$_SESSION['passwd'] = $arr['passwd'];
			echo "USER WAS SUCCESFULLY LOGGED IN\n";
			header("Location: index.php");
		}
		else if ($val['login'] === $arr['login'] && $val['passwd'] !== $arr['oldpw'])
			echo "WRONG PASSWORD\n";
	}
}
?>
<!DOCTYPE HTML>
<title>Connexion</title>
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
	    	</ul>
        </nav>
	</header>
	<div class="main_wrapper">
		<div class="form_div">
		<form action="connexion.php" method="post">
			Identifiant: <input type="text" name="login" value="" required/>
			<br />
			Mot de passe: <input type="password" name="passwd" value="" required/>
			<input type="submit" value="OK" name="submit" />
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