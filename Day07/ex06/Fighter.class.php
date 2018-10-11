<?php

abstract class Fighter
{
    abstract public function fight($target);

    private $name;

    public function __construct($class_name)
    {
        return $this->name = $class_name;
    }

    public function getClassStr()
    {
        return $this->name;
    }

}

?>