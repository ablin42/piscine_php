<?php

include_once('Jaime.class.php');
include_once('Tyrion.class.php');

class Stark {
}

class Sansa extends Stark {
}

$j = new Jaime();
$t = new Tyrion();
$s = new Sansa();

$j->sleepWith($t);
$j->sleepWith($s);

$t->sleepWith($j);
$t->sleepWith($s);

?>
