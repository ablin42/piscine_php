<?php

class Jaime extends Lannister
{

    public function with($char)
    {
        if (get_class($char) === "Cersei")
            return "With pleasure, but only in a tower in Winterfell, then.";
        else if (get_parent_class($char) === "Lannister")
            return "Not even if I'm drunk !";
        else
            return "Let's do this.";

    }

}

?>

