<?php
if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['newpw']) && isset($_POST['oldpw'])
	&& $_POST['submit'] === "OK" && $_POST['login'] !== "" && $_POST['oldpw'] !== ""
	&& $_POST['newpw'] !== "")
{
	$arr['login'] = $_POST['login'];
	$arr['oldpw'] = hash("whirlpool", $_POST['oldpw']);
	$arr['newpw'] = hash("whirlpool", $_POST['newpw']);
	$folder = "../private";
	$file = "../private/passwd";
	$tab = unserialize(file_get_contents($file));
	foreach ($tab as $key => $val)
	{
		if ($val['login'] === $arr['login'] && $val['passwd'] === $arr['oldpw'])
		{
			$tab[$key]['passwd'] = $arr['newpw'];
			$serialized = serialize($tab);
			file_put_contents($file, $serialized);
			echo "OK\n";
			header("Location: index.html");
			exit ();
		}
		else if ($val['login'] === $arr['login'] && $val['passwd'] !== $arr['oldpw'])
		{
			echo "ERROR\n";
			exit ();
		}
	}
	echo "ERROR\n";
}
else
	echo "ERROR\n";
?>
