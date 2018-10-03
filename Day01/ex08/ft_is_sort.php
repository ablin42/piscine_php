<?php
function	ft_is_sort($tab)
{
	$arr = $tab;
	sort($arr);
	if ($arr === $tab)
		return (true);
	return (false);
}
?>
