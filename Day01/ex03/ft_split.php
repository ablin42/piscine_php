<?php
function ft_split($string)
{
	$arr = preg_split('/ +/', $string);
	sort($arr);
	return $arr;
}
?>
