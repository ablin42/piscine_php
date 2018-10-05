<?php
if (isset($_GET['action']) && isset($_GET['name']))
{
//	echo "[{$_GET['action']}]\n";
// array_key_exists("name"; $_GET);
	if ($_GET['action'] === "set" && isset($_GET['value']))
		setcookie($_GET['name'], $_GET['value'], time() + (365 * 24 * 60 * 60), '/');
	else if ($_GET['action'] === "get")
	{
		if (isset($_COOKIE[$_GET['name']]))
				echo "{$_COOKIE[$_GET['name']]}\n";
	}
	else if ($_GET['action'] === "del")
		setcookie($_GET['name'], "", 0, '/');
}
?>
