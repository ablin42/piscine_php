#!/usr/bin/php
<?php
if ($argc > 2)
{
	$given = $argv[1];
	for ($i = 2; $i < $argc; $i++)
	{
		$arr = explode(":", $argv[$i]);//
		//if (count($arr) != 2)
	//	{
	//	}
		if ($arr[0] == $given)
			$return = $arr[1];
	}
	if ($return != "")
		echo "{$return}\n";
}
?>
