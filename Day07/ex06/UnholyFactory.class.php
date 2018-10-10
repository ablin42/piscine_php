<?php

class UnholyFactory
{
    private $arr = array();
    public function absorb ($class)
    {
        if ($class instanceof Fighter)
        {
            if (in_array($class, $this->arr))
                print("(Factory already absorbed a fighter of type ");
            else
            {
                print("(Factory absorbed a fighter of type ");
                $this->arr[] = $class;
            }
            print($class->getClass() . ")" . PHP_EOL);
        }
        else
            print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
    }

    public function fabricate($rf)
    {
       // if ()
            print("(Factory fabricates a fighter of type " . $rf . ")" . PHP_EOL);
        return ;
    }
}

?>