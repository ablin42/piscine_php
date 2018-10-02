#!/usr/bin/php
<?php
if ($argc >= 2)
{
	$arr = explode(" ", trim($argv[1]));
	$nb = count($arr);
	for ($i = 0; $i < $nb; $i++)
	{
		if ($arr[$i] == "")
			unset ($arr[$i]);
	}
	$first = $arr[0];
	$arr[$nb] = $first;
	for ($i = 1; $i < $nb ; $i++)
	{
		echo "{$arr[$i]} ";
	}
	echo "{$arr[$i]}\n";
}
?>
