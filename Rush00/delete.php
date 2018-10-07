<?php
session_start(); 
if (isset($_SESSION['login']) && $_SESSION['login'] == "")
	header ("Location: index.php");
else
{
	include ("connect_db.php");

   	$login = $_SESSION['login'];
 	$res = mysqli_query($link, "DELETE FROM `users` WHERE `login` = '".$login."'");
	mysqli_close($link);
	session_destroy();
	header ("Location: index.php");
}
?>