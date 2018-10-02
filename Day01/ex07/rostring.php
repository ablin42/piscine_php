#!/usr/bin/php
<?php
if ($argc >= 2)
{
	$arr = preg_split('/ +/', trim($argv[1]));
	$nb = count($arr);
	$first = $arr[0];
	$arr[$nb] = $first;
	for ($i = 1; $i < $nb ; $i++)
	{
		echo "{$arr[$i]} ";
	}
	echo $arr[$i];
	print("\n");
}
?>
