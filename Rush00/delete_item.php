<?php
session_start();
if (isset($_SESSION['auth']) && $_SESSION['auth'] != 1)
	header ("Location: index.php");	
else
{
	include ("connect_db.php");
   	$ID = mysqli_real_escape_string($link, $_GET['item_id']);
	
	mysqli_query($link, "DELETE FROM `items` WHERE `ID` = '".$ID."'");  
	mysqli_close($link);
	header ("Location: admin.php");
}
?>