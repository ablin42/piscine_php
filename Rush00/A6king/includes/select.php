<?php
     $perPagei = $maxlimit;
       $nbPagei = ceil($total/$perPagei);
       if(isset($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <=$nbPagei)
         {
          $cPagei = $_GET['page'];
         }
         else
         {
          $cPagei = 1;
         }   
     
     $premiereEntree = ($cPagei-1)*$perPagei;
?>