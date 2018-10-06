<?php
session_start();
$_SESSION = array();
session_destroy();
setcookie('auth', '', time() - 24*3600, '/', 'localhost', false, false);
header('Location: index.php');
?>