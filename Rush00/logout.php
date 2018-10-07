<?php
session_start(['cookie_lifetime' => -1]);
$_SESSION["login"] = "";
session_destroy();
header ("Location: index.php");
?>
