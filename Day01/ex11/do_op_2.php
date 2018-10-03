#!/usr/bin/php
<?php
if ($argc != 2)
{
	print("Incorrect Parameters\n");
	exit();
}
else if ($argc == 2)
{
	$str = preg_replace('/\s+/', '', trim($argv[1]));
	$count = count($str);
	$i = 0;
	if ($str[0] === '-')
		$i = 1;
	while ($str[$i] >= '0' && $str[$i] <= '9')
		$i++;
	$char = $str[$i];
	$str[$i] = 'X';
	$arr = explode("X", $str);
	if (!is_numeric(trim($arr[0])) || !is_numeric(trim($arr[1])) || count($arr) != 2)
	{
		print("Syntax Error\n");
		exit();
	}
	else
	{
		if ($char === '+')
			$result = $arr[0] + $arr[1];
		else if ($char === '-')
			$result = $arr[0] - $arr[1];
		else if ($char === '*')
			$result = $arr[0] * $arr[1];
		else if ($char === '/')
			$result = $arr[0] / $arr[1];
		else if ($char === '%')
			$result = $arr[0] % $arr[1];
		else
		{
			print("Syntax Error\n");
			exit();
		}
	}
	echo "{$result}\n";
}
?>
