#!/usr/bin/php
<?php
if ($argc != 4)
	print("Incorrect Parameters\n");
else if ($argc == 4)
{
	for ($i = 1; $i < $argc; $i++)
		$argv[$i] = trim($argv[$i]);
	if ($argv[2] === "+")
		$result = $argv[1] + $argv[3];
	else if ($argv[2] === "-")
		$result = $argv[1] - $argv[3];
	else if ($argv[2] === "*")
		$result = $argv[1] * $argv[3];
	else if ($argv[2] === "/")
		$result = $argv[1] / $argv[3];
	else if ($argv[2] === "%")
		$result = $argv[1] % $argv[3];
	echo "{$result}\n";
}
?>
