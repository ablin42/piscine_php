<?php
function ft_split($string)
{
	$arr = explode(" ", trim($string));
	$count = count($arr);
	for ($i = 0; $i < $count; $i++)
	{
		if ($arr[$i] == "")
			unset ($arr[$i]);
	}
	sort($arr);
	return $arr;
}
?>
