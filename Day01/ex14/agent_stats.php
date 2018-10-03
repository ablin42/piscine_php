#!/usr/bin/php
<?php
//User;Note;Noteur;Feedback
if ($argc == 2)
{
	$tab = file('php://stdin');
	unset ($tab[0]);
	if ($argv[1] == "moyenne")
	{
		$nbnote = 0;
		$total = 0;
		foreach ($tab as $line)
		{
			$arr = explode(";", $line);
			//print_r($arr);
			if ($arr[2] !== "moulinette" && is_numeric($arr[1]))
			{
				$total = $total + $arr[1];
				$nbnote++;
			}
		}
		$result = ($total / $nbnote);
		echo "{$result}\n";
	}
	if ($argv[1] == "moyenne_user")
	{
		foreach ($tab as $line)
	}
}
?>
