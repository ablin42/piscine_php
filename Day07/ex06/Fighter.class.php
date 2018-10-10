<?php

class Fighter
{
    public $type_fighter;
    function __construct($class_name)
    {
        return $this->type_fighter = $class_name;
    }

    function getClass()
    {
        return $this->type_fighter;
    }
}

?>