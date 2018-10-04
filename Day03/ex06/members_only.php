<?php
//header(), echo. $_SERVER, file_get_contents, base64_encode
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
{
	if ($_SERVER['PHP_AUTH_USER'] === "zaz"
	&& $_SERVER['PHP_AUTH_PW'] === "jaimelespetitsponeys")
	{

	}
	else
	{
		//error_msg
		//header();
		//<html><body>Cette zone est accessible uniquement aux membres du site</body></html>
		//* Closing connection #0
	}
	header('WWW-Authenticate: Basic realm="My Realm"');
}
?>
