#!/usr/bin/php
<?php
//Jour_de_la_semaine Numéro_du_jour Mois Année Heures:Minutes:Secondes
if (0 === 1)
{
	echo "ERROR\n";
}
else
{
	//Thursday 1 January 1970 00:00:00
	$timestamp = 0;
	$arr = explode(" ", $argv[1]);
	$time = explode(":", $arr[4]);
	print_r ($arr);
	/*$arr[0] = ucfirst($arr[0]);
	$day = array(Lundi => 0, Mardi => 86400, Mercredi => 172800, Jeudi => 259200,
					Vendredi => 345600, Samedi => 432000, Dimanche => 518400);
	$timestamp += $day[$arr[0]]; this is for the day but i dont think its necessary*/
	if ($arr[1] > 1)
		$timestamp += ($arr[1] - 1) * 86400;
	$arr[2] = ucfirst($arr[2]);
	//31  28(29)  31  30  31  30  31  31  30  31  30  31
	$month =  array(
			Janvier => 0,
			Fevrier => 31,
			Mars => 59,
			Avril => 80,
			Mai => 110,
			Juin => 141,
			Juillet => 171,
			Aout => 202,
			Septembre => 233,
			Octobre => 263,
			Novembre => 294,
			Decembre => 324,
		);
	echo "{$timestamp}\n";
//	echo "{$month[$arr[2]]}\n";
	$timestamp += $month[$arr[2]] * 86400;
	echo "{$timestamp}\n";
	$timestamp += ($arr[3] - 1970) *  31536000;
	echo "{$timestamp}\n";
	$timestamp += $time[0] * 3600;
	echo "{$timestamp}\n";
	$timestamp += $time[1] * 60;
	echo "{$timestamp}\n";
	$timestamp += $time[2];
	echo "{$timestamp}\n";
	mktime();
}
?>
