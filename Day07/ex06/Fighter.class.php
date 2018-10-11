<?php

abstract class Fighter
{
    abstract public function fight($target);

    private $type;

    function __construct($class_name)
    {
        return $this->type = $class_name;
    }

    function getClassStr()
    {
        return $this->type;
    }
}

?>