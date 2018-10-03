#!/usr/bin/php
<?php
//Jour_de_la_semaine Numéro_du_jour Mois Année Heures:Minutes:Secondes
$arr = explode(" ", $argv[1]);
if (count($arr) != 5)
{
	echo "Wrong format\n";
	exit();
}
print_r ($arr);
if (preg_match("/((^[Ll]undi)|(^[Mm]ardi)|(^[Mm]ercredi)|(^[Jj]eudi)|(^[Vv]endredi)|(^[Ss]amedi)|(^[Dd]imanche))/", $arr[0]) !== 1)//, $output_array);
{
	echo "Wrong format\n";
	exit();
}
if ((strlen($arr[1]) !== 1 && strlen($arr[1]) !== 2) || is_numeric($arr[1]) === false)
{

	echo "Wrong format\n";
	exit();
}
if (preg_match("/((^[Jj]anvier$)|(^[Ff][eé]vrier$)|(^[Mm]ars$)|(^[Aa]vril$)|(^[Mm]ai$)|(^[Jj]uin$)|(^[Jj]uillet$)|(^[Aa]ou[uû]t$)|(^[Ss]eptembre$)|(^[Nn]ovembre$)|(^[Oo]ctobre$)|(^[Dd][eé]cembre$))/", $arr[2]) !== 1)
{
	echo "Wrong format\n";
	exit();
}
if (strlen($arr[3]) !== 4 || is_numeric($arr[3]) == false)
{

	echo "Wrong format\n";
	exit();
}
$time = explode(":", $arr[4]);
print_r ($time);
if (count($time) !== 3 || strlen($time[0]) !== 2 || strlen($time[1]) !== 2 || strlen($time[2]) !== 2
	|| is_numeric($time[0]) === false || is_numeric($time[1]) === false || is_numeric($time[2]) === false)
{
	echo "Wrong format\n";
	exit();
}
$month =  array(
	Janvier => 1,
	Fevrier => 2,
	Mars => 3,
	Avril => 4,
	Mai => 5,
	Juin => 6,
	Juillet => 7,
	Aout => 8,
	Septembre => 9,
	Octobre => 10,
	Novembre => 11,
	Decembre => 12,
);
date_default_timezone_set('Europe/Amsterdam');
$timestamp = mktime($time[0], $time[1], $time[2], $month[$arr[2]], $arr[1], $arr[3]);
echo "{$timestamp}\n";
?>
