<?php
session_start();
include ("auth.php");
if (isset($_POST['login']) && isset($_POST['passwd']))
{
	if (auth($_POST['login'], $_POST['passwd']) === true)
	{
		echo "<iframe height=\"550px\" src=\"chat.php\"></iframe>";
		echo "<iframe height=\"55px\" src=\"speak.php\"></iframe>";
	}
	else
	{
		echo "ERROR\n";
	}
}
?>
