#!/usr/bin/php
<?php
$str = "";
if ($argc > 1)
{
	for ($i = 1; $i < $argc; $i++)
		$str .= " {$argv[$i]} ";
	$arr = explode(" ", trim($str));
	sort($arr);
	$nb = count($arr);
	for ($j = 0; $j < $nb; $j++)
	{
		if ($arr[$j] != "")
			echo "{$arr[$j]}\n";
	}
}
?>
