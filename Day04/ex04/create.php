<?php
if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['passwd']) && $_POST['submit'] === "OK" && $_POST['login'] !== "" && $_POST['passwd'] !== "")
{
	$arr['login'] = $_POST['login'];
	$arr['passwd'] = hash("whirlpool", $_POST['passwd']);
	$folder = "../private";
	$file = "../private/passwd";
	if (!file_exists($folder))
		mkdir($folder);
	if (!file_exists($file))
		file_put_contents($file, null);
	$tab = unserialize(file_get_contents($file));
	foreach ($tab as $key => $val)
	{
		if ($val['login'] === $arr['login'])
		{
			echo "ERROR\n";
			exit ();
		}
	}
	$tab[] = $arr;
	$serialized = serialize($tab);
	file_put_contents($file, $serialized);
	echo "OK\n";
	header("Location: index.html");
}
else
	echo "ERROR\n";
?>
