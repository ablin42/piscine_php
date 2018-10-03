#!/usr/bin/php
<?php
$str = preg_replace("/[\t|' ']+/", " ", trim($argv[1], " \t"));
echo "{$str}\n";
?>
