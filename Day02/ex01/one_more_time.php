#!/usr/bin/php
<?php
if ($argc > 1)
{
	function	output_err()
	{
		echo "Wrong format\n";
		exit();
	}
	$arr = explode(" ", $argv[1]);
	if (count($arr) != 5)
		output_err();

	if (preg_match("/((^[Ll]undi)|(^[Mm]ardi)|(^[Mm]ercredi)|(^[Jj]eudi)|(^[Vv]endredi)|(^[Ss]amedi)|(^[Dd]imanche))/", $arr[0]) !== 1)//, $output_array);
		output_err();

	if ((strlen($arr[1]) !== 1 && strlen($arr[1]) !== 2) || is_numeric($arr[1]) === false)
		output_err();

	if (preg_match("/((^[Jj]anvier$)|(^[Ff]évrier$)|(^[Mm]ars$)|(^[Aa]vril$)|(^[Mm]ai$)|(^[Jj]uin$)|(^[Jj]uillet$)|(^[Aa]oût$)|(^[Ss]eptembre$)|(^[Nn]ovembre$)|(^[Oo]ctobre$)|(^[Dd]écembre$))/", $arr[2]) !== 1)
		output_err();

	if (strlen($arr[3]) !== 4 || is_numeric($arr[3]) == false)
		output_err();

	$time = explode(":", $arr[4]);
	if (count($time) !== 3 || strlen($time[0]) !== 2 || strlen($time[1]) !== 2 || strlen($time[2]) !== 2
		|| is_numeric($time[0]) === false || is_numeric($time[1]) === false || is_numeric($time[2]) === false)
		output_err();

	if (($time[0]) < 0 || $time[0] > 23 || ($time[1] < 0 || $time[1] > 59) || ($time[2] < 0 || $time[2] > 59))
		output_err();

	$month =  array(Janvier => 1, Février => 2, Mars => 3, Avril => 4, Mai => 5, Juin => 6, Juillet => 7, Août => 8, Septembre => 9, Octobre => 10, Novembre => 11, Décembre => 12);

	if (!checkdate($month[$arr[2]], $arr[1], $arr[3]))
		output_err();

	date_default_timezone_set('Europe/Paris');//amster
	$timestamp = mktime($time[0], $time[1], $time[2], $month[$arr[2]], $arr[1], $arr[3]);
	echo "{$timestamp}\n";
}
?>
