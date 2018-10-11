<?php

class Tyrion extends Lannister
{

   public function with($char)
   {
        if (get_parent_class($char) === "Lannister")
            return "Not even if I'm drunk !";
        else
            return "Let's do this";
   }

}

?>