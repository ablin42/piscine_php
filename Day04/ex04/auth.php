<?php
//hash(), file_get_contents(), file_put_contents(),
//serialize(), unserialize()

function auth($login, $passwd)
{
	if ($login == "" || $passwd == "")
		return (false);
	$tab = unserialize(file_get_contents("../private/passwd"));
	if (!$tab)
		return (false);
	$hpasswd = hash("whirlpool", $passwd);
	foreach ($tab as $key => $val)
	{
		if ($val['login'] === $login && $val['passwd'] === $hpasswd)
			return (true);
	}
	return (false);
}
?>
