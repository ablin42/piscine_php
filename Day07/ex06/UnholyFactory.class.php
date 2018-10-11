<?php

class UnholyFactory
{
    private $arr = array();

    public function absorb ($name)
    {
        if ($name instanceof Fighter)
        {
            if (array_key_exists($name->getClassStr(), $this->arr))
                print("(Factory already absorbed a fighter of type ");
            else
            {
                print("(Factory absorbed a fighter of type ");
                $this->arr[$name->getClassStr()] = $name;
            }
            print($name->getClassStr() . ")" . PHP_EOL);
        }
        else
            print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
    }

    public function fabricate($name)
    {
       if (array_key_exists($name, $this->arr))
       {
           print("(Factory fabricates a fighter of type " . $name . ")" . PHP_EOL);
           return (clone $this->arr[$name]);
       }
       else
           print("(Factory hasn't absorbed any fighter of type " . $name . ")" . PHP_EOL);
       return false;
    }
}

?>