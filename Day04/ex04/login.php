<?php
session_start();
include ("auth.php");
if (isset($_POST['login']) && isset($_POST['passwd']))
{
	if (auth($_POST['login'], $_POST['passwd']) === true)
	{
		$_SESSION['loggued_on_user'] = $_POST['login'];?>
		<!DOCTYPE html>
			<html>
			<head>
					<meta charset="UTF-8">
					<title>42Chat</title>
			</head>
			<body>
					<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
					<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
			</body>
		</html>
<?php }
else
{
//	header("Location: index.html");
	echo "ERROR\n";
}
}
?>
