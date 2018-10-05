<?php
//hash(), file_get_contents(), file_put_contents(),
//serialize(), unserialize()
if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['passwd']))
{
	if ($_POST['submit'] === "OK" && $_POST['login'] !== "" && $_POST['passwd'] !== "")
	{
		$arr['login'] = $_POST['login'];
		$arr['passwd'] = hash("whirlpool", $_POST['passwd']);
	}
	else
	{
		echo "ERROR\n";
		exit ();
	}
	$folder = "../private";
	$file = "../private/passwd";
	if (!file_exists($folder))
		mkdir($folder);
	if (!file_exists($file))
	{
		$serialized = serialize($arr);
		file_put_contents($file, $serialized);
	}
	else
	{
		$tab = unserialize(file_get_contents($file));
		if ($tab['login'] === $arr['login'])
		{
			echo "ERROR\n";
			exit ();
		}
		foreach ($tab as $elem)
		{
			foreach ($elem as $login => $val)
			{
				if ($val === $arr['login'])
				{
					echo "ERROR\n";
					exit ();
				}
			}
		}
		$tab[] = $arr;
		$serialized = serialize($tab);
		file_put_contents($file, $serialized);
		echo "OK\n";
	}
}
?>
