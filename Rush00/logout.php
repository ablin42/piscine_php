<?php
session_start(['cookie_lifetime' => -1]);
$_SESSION["login"] = "";
header ("Location: index.php");
?>
