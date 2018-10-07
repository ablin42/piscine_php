<?php
session_start();
include ("connect_db.php");
if (!$link)
	echo "rate";
else
	echo "[{$db}]";

	mysqli_query($link, "CREATE TABLE `items` (
  						`ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
						`name` varchar(255) DEFAULT NULL,
						`prix` decimal(10,0) DEFAULT '0',
						`category` int(11) NOT NULL DEFAULT '0',
						`url` varchar(500) DEFAULT NULL)"); 
	
	mysqli_query($link, "CREATE TABLE `users` (
						`ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
						`login` varchar(255) DEFAULT NULL,
						`password` varchar(1000) DEFAULT NULL,
						`email` varchar(1000) DEFAULT NULL,
						`address` varchar(255) DEFAULT NULL,
						`auth` int(2) NOT NULL DEFAULT '0')");

	$rootpw = hash(whirlpool, "root");
	$rootma = hash(whirlpool, "root@42.fr");
	mysqli_query($link, "INSERT INTO `users` (`ID`, `login`, `password`, `email`, `address`, `auth`) VALUES
(0, 'root', '".$rootpw."', '".$rootma."', '42 RUE DU 42', 1)");


header ("Location: index.php");