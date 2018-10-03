#!/usr/bin/php
<?php

function custom_sort($a, $b)
{
	$ca = strtolower($a);
	$cb = strtolower($b);
	$i = 0;
	$comp = "abcdefghijklmnopqrstuvwxyz0123456789!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
	while (($i < strlen($a)) || ($i < strlen($b)))
	{
		$posa = strpos($comp, $ca[$i]);
		$posb = strpos($comp, $cb[$i]);
		if ($posa < $posb)
			return (-1);
		else if ($posa > $posb)
			return (1);
		else
			$i++;
	}
}

if ($argc > 1)
{
	$str = "";
	for ($i = 1; $i < $argc; $i++)
		$str .= " {$argv[$i]} ";
	$arr = explode(" ", trim($str));
	$count = count($arr);
	for ($i = 0; $i < $count; $i++)
	{
		if ($arr[$i] === "")
			unset ($arr[$i]);
	}
	$arr = array_values($arr);
	usort($arr, "custom_sort");
	$nb = count($arr);
	for ($j = 0; $j < $nb; $j++)
	{
		if ($arr[$j] === "")
			unset ($arr[$j]);
	}
	$arr = array_values($arr);
	foreach ($arr as $val)
	{
		if (ctype_alpha($val[0]) == 1)
			echo "{$val}\n";
	}
	foreach ($arr as $val)
	{
		if (ctype_digit($val[0]) == 1)
			echo "{$val}\n";
			}
	foreach ($arr as $val)
	{
		if (ctype_alpha($val[0]) == 0 && ctype_digit($val[0]) == 0)
			echo "{$val}\n";
	}
}
?>
