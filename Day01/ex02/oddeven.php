<?php
while (1)
{
	print("Entrez un nombre: ");
	//$handle = fopen("php://stdin", "r");
	$line = fgets(STDIN);
	if (feof(STDIN) == true)
		exit();
	$trimed = trim($line);//can stack fgets into trim
	if (!is_numeric($trimed))
	{
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
