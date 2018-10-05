<?php
//hash(), file_get_contents(), file_put_contents(),
//serialize(), unserialize(), file_exists(), mkdir()
session_start();
if (isset($_GET['submit']) && isset($_GET['login']) && isset($_GET['passwd']))
{
	if ($_GET['submit'] === "OK" )
	{
		$_SESSION['login'] = $_GET['login'];
		$_SESSION['passwd'] = $_GET['passwd'];
	}
}
?>
