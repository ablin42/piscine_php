#!/usr/bin/php
<?php
if ($argc != 2)
{
	print("Incorrect Parameters\n");
	exit();
}
else if ($argc == 2)
{/*
	$arr = explode(" ", trim($argv[1]));
	$count = count($arr);
	for ($i = 0; $i < $count; $i++)
	{
		if ($arr[$i] == "")
			unset ($arr[$i]);
	}
	$arr = array_values($arr);*/
	$str = preg_replace('/\s+/', ' ', $argv[1]);
	//echo "{$str}\n";
	$arr = preg_split("/(['+''-''*''\/''%'])/", $str, -1,  PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
	print_r ($arr);
	if (!is_numeric(trim($arr[0])) || !is_numeric(trim($arr[2])) || count($arr) != 3)
	{
		print("Syntax Error\n");
		exit();
	}
	else
	{
		if ($arr[1] == "+")
			$result = $arr[0] + $arr[2];
		else if ($arr[1] == "-")
			$result = $arr[0] - $arr[2];
		else if ($arr[1] == "*")
			$result = $arr[0] * $arr[2];
		else if ($arr[1] == "/")
			$result = $arr[0] / $arr[2];
		else if ($arr[1] == "%")
			$result = $arr[0] % $arr[2];
		else
		{
			print("Syntax Error\n");
			exit();
		}
	}
	echo "{$result}\n";
}
?>
