<?php

class UnholyFactory
{
    private $arr = array();

    public function absorb ($class)
    {
        if ($class instanceof Fighter)
        {
            if (in_array($class->getClassStr(), $this->arr))
                print("(Factory already absorbed a fighter of type ");
            else
            {
                print("(Factory absorbed a fighter of type ");
                $this->arr[] = $class->getClassStr();
            }
            print($class->getClassStr() . ")" . PHP_EOL);
        }
        else
            print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
    }

   /* private function getClass($rf)
    {
        if ($rf === "foot soldier")
            return new Footsoldier;
        if ($rf === "archer")
            return new Archer;
        if ($rf === "assassin")
            return new Assassin;
        if ($rf === "llama")
            return new Llama;
    }*/

    public function fabricate($rf)
    {
       if (in_array($rf, $this->arr))//if in array Llama after getting type from instance called
       {
           print("(Factory fabricates a fighter of type " . $rf . ")" . PHP_EOL);
           return $this->class;//$this->getClass($rf);
       }
       else
           print("(Factory hasn't absorbed any fighter of type " . $rf . ")" . PHP_EOL);
       return false;
    }

}

?>