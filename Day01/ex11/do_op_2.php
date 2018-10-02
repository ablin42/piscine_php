#!/usr/bin/php
<?php
if ($argc < 2)//!=2
{
	print("Incorrect Parameters\n");
	exit();
}
/*else if ($argc == 2 && count(preg_split('/ /', $argv[1], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY)) > 3)//!= 3
{
	print_r(preg_split('/ /', $argv[1], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY));
	print("Syntax Error1\n");
	exit();
}*/
else if ($argc == 2)//>= 2?
{
//	$test = trim(preg_replace('/\s+/', ' ', $argv[1]));
//	echo "{$test}\n";
//	print_r(preg_split("/ /", $argv[1], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY));

	//exit();
//	echo "{$argv[1]}\n";
	$str = preg_replace('/\s+/', ' ', $argv[1]);
	//echo "{$str}\n";
	$arr = preg_split("/(['+''-''*''\/''%'])/", $str, -1,  PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
//	print_r($arr);
	if (!is_numeric(trim($arr[0])) || !is_numeric(trim($arr[2])) || count($arr) != 3)
	{
		print("Syntax Error2\n");
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
			print("Syntax Error3\n");//useless since arr[1] tjrs un delimiter
			exit();
		}
	}
	echo "{$result}\n";
}
?>
