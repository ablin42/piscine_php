<?php
try 
{
$bdd = new PDO('mysql:host=localhost;dbname=6asking', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); // On se connecte à la BDD
}
catch(Exception $e)
{
die('Erreur: '.$e->getMessage());   //On affiche un message s'il y a une erreur
}  

if(isset($_COOKIE['auth']))
{
	$auth = $_COOKIE['auth'];
	$auth = explode('---x---', $auth);
	$user = $bdd->prepare('SELECT * FROM membre WHERE ID = :ID');
	$user->execute(array('ID' => $auth[0]));
	$membre = $user->fetch();

	$key = sha1($membre['pseudo'] . $membre['password'] . $_SERVER['REMOTE_ADDR']);

	if($key == $auth[1])
	{
		//$_SESSION['Auth']
		setcookie('auth', $membre['ID'] . '---x---' . $key, time() + 7*24*3600, '/', 'localhost', false, false);
	}
	else
	{
		echo'lol';
		setcookie('auth', '', time() - 24*3600, '/', 'localhost', false, false);
	}

}
else
{
echo'kk';

}

?>
<!--  -->