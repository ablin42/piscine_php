#!/usr/bin/php
<?php
//User;Note;Noteur;Feedback
if ($argc > 1)//
{
	//option “moyenne” qui calcule la moyenne de toutes les notes hors moulinette
	if ($argv[1] == "moyenne")
		$mode = 0;
	else if ($argv[1] == "moyenne_user")//option “moyenne_user” qui calcule la moyenne par user et par ordre alphabétique
		$mode = 1;
	else if ($argv[1] == "ecart_moulinette")
		$mode = 2;
	else
		$mode = -1;
	if ($mode == -1)
		exit();
	$nbnote_nm = 0;
	$total_nm = 0;
	while (($line = fgets(STDIN)) != "" && feof(STDIN) != true)
	{
		$arr = explode(";", $line);
		//print_r($arr);
		if ($mode == 0)
		{
			if ($arr[2] != "moulinette" && is_numeric($arr[1]))
			{
				$total_nm = $total_nm + $arr[1];
				$nbnote_nm++;
			}
		}
		else if ($mode == 1)
		{

		}
	}
	if ($mode == 0)
	{
		$result = ($total_nm / $nbnote_nm);// + ($total_nm % $nbnote_nm);
		echo "{$result}\n";
	}
}
?>
