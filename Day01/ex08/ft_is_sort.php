<?php
function	ft_is_sort($tab)
{
	$nb = count($tab);
//	print_r($tab);
	for ($i = 0; $i < $nb - 1; $i++)
	{
//		echo "{$tab[$i]} {$tab[$i + 1]}\n";
		if ($tab[$i] > $tab[$i + 1])
			return (false);
	}
	return (true);
}
?>
