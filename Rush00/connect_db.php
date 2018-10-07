<?php 
$servername = "localhost";
$username = "root";
$password = "yFNecV3s";
$db = "xd";

$link = mysqli_connect($servername, $username, $password, $db);
if (!$link) {
  	die("Connection failed: " . mysqli_connect_error());}
?>
