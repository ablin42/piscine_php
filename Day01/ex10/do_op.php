#!/usr/bin/php
<?php
if ($argc < 4)//!=4
{
	print("Incorrect Parameters\n");
}
else if ($argc == 4)//>= 4?
{
	print_r($argv);
	for ($i = 1; $i < $argc; $i++)
	{
		$argv[$i] = trim($argv[$i]);
	}
	print_r($argv);
	if ($argv[2] == "+")
		$result = $argv[1] + $argv[3];
	else if ($argv[2] == "-")
		$result = $argv[1] - $argv[3];
	else if ($argv[2] == "*")
		$result = $argv[1] * $argv[3];
	else if ($argv[2] == "/")
		$result = $argv[1] / $argv[3];
	else if ($argv[2] == "%")
		$result = $argv[1] % $argv[3];
	echo "{$result}\n";
}
?>
