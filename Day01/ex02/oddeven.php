#!/usr/bin/php
<?php
while (1)
{
	print("Entrez un nombre: ");
	$line = fgets(STDIN);
	$trimed = trim($line);
	if (!is_numeric($trimed))
	{
		if (feof(STDIN) == true)
		{
			echo "\n";
			exit();
		}
		echo ("'{$trimed}' n'est pas un chiffre\n");
	}
	else
	{
		if ($trimed % 2 == 0)
			echo ("Le chiffre {$trimed} est Pair\n");
		else
			echo ("Le chiffre {$trimed} est Impair\n");
	}
}
?>
