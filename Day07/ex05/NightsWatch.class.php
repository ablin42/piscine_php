<?php

class NightsWatch
{
    private $call;
    public function recruit($name)
    {

        if (get_class($name) === "JonSnow")
        {
            $call = new JonSnow();
            $call->fight();
        }
        else if (get_class($name) === "SamwellTarly")
        {
            $call = new SamwellTarly();
            $call->fight();
        }
        else if (get_class($name) === "Varys")
        {
            $call = new Varys();
            $call->fight();
        }
    }

    public function fight()
    {

    }
}
?>