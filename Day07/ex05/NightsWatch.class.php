<?php

class NightsWatch implements IFighter
{

    public function recruit($char)
    {
        if ($char instanceof IFighter)
            $char->fight();
    }

    public function fight()
    {

    }

}
?>