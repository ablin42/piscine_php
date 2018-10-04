#!/usr/bin/php
<?php
function	up($match)
{
	$upp = strtoupper($match);
	$new = "title=\"{$upp}\"";
	return ($new);
}

function upper($matches)
{
	$count = count($matches);
	$reg = "(>[^<]*<)";
	$repm = "(^title=\"(.*)\"$)";//
	for ($i = 0; $i < $count; $i++)
	{
		if (preg_match($repm, $matches[$i]) === 1)
		{
			unset ($matches[$i]);
			$i += 2;
		}
		if (preg_match($reg, $matches[$i]) == 0 && preg_match($repm, $matches[$i]) == 0)
			unset ($matches[$i]);
	}
	print_r ($matches);
	$rep = "(title=\"(.*)\")";//.* isnt good
	$lastreg = "([^><]*)";
	for ($i = 1; $i < $count; $i++)
	{
		//if ($matches[$i] != "" && preg_match($repm, $matches[$i]) === 1)
			$result = preg_replace($lastreg, up($matches[$i]), $matches[0]);
	//	else if (ctype_print(trim($matches[$i])) == 1)
	//		$result = preg_replace($rep, up($matches[$i]), $matches[0]);
	}
	return ($result);
}

$fd = fopen($argv[1], 'r');
$line = "";
//\i
$tag = "<a.* title=\"?.*\"?>";
$regex = "(<a.* (title=\"?(.*)\")?>)";
$newregex= "(<a ([^>]*(?=title)(title=\"([^\"]*)\"))*([^>]*)(>[^<]*<)(([^>]*(title=\"([^\"]*)\"))>)*)";

while (!feof($fd))
	$line .= fgets($fd);
fclose ($fd);
//$new = preg_replace_callback($regex, up, $line);
$new = preg_replace_callback($newregex, upper, $line);
echo "\n{$new}\n";
//(<a.* (title="?(.*)")?\>(.*)<)
//<a.* (title="?(.*)")?\>(.*)<
//(<a[^>]*>([^<]*))
//title="[^"]*"
//(<a[^>]*(title="([^"]*)")*([^>]*)>([^<]*)(<([^>]*(title="([^"]*)"))>)*)
?>
