#!/usr/bin/php
<?php
$str = "";
if ($argc > 1)
{
	for ($i = 1; $i < $argc; $i++)
		$str .= " {$argv[$i]} ";
	$arr = explode(" ", trim($str));
//	print_r ($arr);
	natcasesort($arr);
	$nb = count($arr);
	for ($j = 0; $j < $nb; $j++)
	{
		if ($arr[$j] === "")
			unset ($arr[$j]);
	}
	$arr = array_values($arr);
//	print_r($arr);
	foreach ($arr as $val)
	{
		if (ctype_alpha($val[0]) == 1)
			echo "{$val}\n";
	}
	sort($arr, SORT_LOCALE_STRING);
//	print_r($arr);
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
