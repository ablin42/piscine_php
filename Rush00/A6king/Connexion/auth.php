<?php
include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');

class Auth
{ 
    static function islog()
    {
        global $bdd;
        
        if (isset($_SESSION['Auth']) AND isset($_SESSION['Auth']['pseudo']) AND isset($_SESSION['Auth']['password'])
            AND isset($_SESSION['Auth']['ID']) AND isset($_SESSION['Auth']['OP']) AND isset($_SESSION['Auth']['token']) AND isset($_SESSION['Auth']['token_time']))
        {
           $q = array(
                      'pseudo'   => $_SESSION['Auth']['pseudo'],
                      'password' => $_SESSION['Auth']['password'],
                      'ID'       => $_SESSION['Auth']['ID']
                      );
           
            $sql = 'SELECT pseudo, password FROM membre WHERE pseudo = :pseudo AND password = :password AND ID = :ID';
            $req = $bdd->prepare($sql);
            $req->execute($q);
            $count = $req->rowCount($sql);
           
            if($count == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
        return false;
        }
    }
}
?>