<?php 
session_start();
$servername = "localhost";
$username = "username";
$password = "password";

$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = $conn->query("SELECT id, firstname, lastname FROM MyGuests");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

if ($_POST['submit'] === "OK" && $_POST['login'] !== "" $_POST['email'] !== "" 
	&& $_POST['address'] !== "" $_POST['passwd'] !== "")
{
	$arr['login'] = $_POST['login'];
	$arr['email'] = $_POST['email'];
	$arr['address'] = $_POST['address']
	$arr['passwd'] = hash("whirlpool", $_POST['passwd']);
	//INSERT_INTO; mysql insert
	foreach ($tab as $key => $val)
	{
		if ($val['login'] === $arr['login'])
		{
			echo "THIS USER ALREADY EXISTS\n";
			exit ();
		}
	}
	echo "USER WAS SUCCESFULLY CREATED\n";
	header("Location: connexion.php");
}
?>
<!DOCTYPE HTML>
<title>Inscription</title>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
   </head>
   
<body>
	<header>
        <nav class="navbar" id="top" role="navigation">
	    	<ul class="nav_ul">
				<li class="nav_li" style="float: left;"><a href="index.php" class="nav_link">Home</a></li>
				<li class="nav_li" style="float:left;"><a href="panier.php" class="nav_link"><?php if (isset($_SESSION['login'])) echo "{$_SESSION['login']}\n";?></a></li>
	    		<li class="nav_li"><a href="panier.php" class="nav_link">Mon panier</a></li>
	    		<li class="nav_li"><a href="connexion.php" class="nav_link">Se connecter</a></li>
	    		<li class="nav_li active"><a href="inscription.php" class="nav_link">S'inscrire</a></li>
	    	</ul>
        </nav>
	</header>
	<div class="main_wrapper">
		<div class="form_div">
		<form action="inscription.php" method="post">
			Identifiant: <input type="text" name="login" value="" required/>
			<br />
			Email: <input type="email" name="email" value="" required/>
			<br />
			Address: <input type="text" name="address" value="" required/>
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