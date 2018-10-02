#!/usr/bin/php
<?php
$str = "";
if ($argc > 1)
{
	for ($i = 1; $i < $argc; $i++)
	{
		$str .= " {$argv[$i]} ";
	}
	$arr = preg_split('/ +/', trim($str));
	sort($arr);
	$nb = count($arr);
	for ($j = 0; $j < $nb; $j++)
	{
		echo "{$arr[$j]}\n";
	}
}
/*print_r($arr);

for ($i = 1; $i < $argc; $i++)
{
//	$str = trim(preg_replace('/\s+/',' ', $argv[$i]));
	//	echo "{$str}\n";
	$arr = preg_split('/ +/', trim($argv[$i]));
	sort($arr);
//	print_r($arr);
}*/
?>
