#!/usr/bin/php
<?php
if ($argc == 2)
{
	$arr = explode(" ", trim($argv[1]));
	$count = count($arr);
	for ($i = 0; $i < $count - 1; $i++)
	{
		if ($arr[$i] !== "")
		{
			echo "{$arr[$i]} ";
		}
	}
	echo "{$arr[$i]}\n";
}
?>
