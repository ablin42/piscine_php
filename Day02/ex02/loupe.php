#!/usr/bin/php
<?php
$fd = fopen($argv[1], 'r');

while ($line = fgets($fd))
{
	echo "{$line}";
}
?>
