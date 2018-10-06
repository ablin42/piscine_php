<?php
if(!empty($_POST))
{
    $pseudo = $_POST['pseudo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $q = array(
               'pseudo'    => $pseudo,
               );
    
    $sql = 'SELECT ID, pseudo, password FROM membre WHERE pseudo = :pseudo';
    $req = $bdd->prepare($sql);
    $req->execute($q);
    $count = $req->rowCount($sql);
    $donnees = $req->fetch();
    
    $hash = $donnees['password'];
    if(password_verify($_POST['password'], $hash))
    {
        if($count == 1) //vérifier si l'utilisateur est actif
        {
            $q = array(
                   'pseudo'    => $pseudo,
                   'password'  => $hash,
                   'ID'        => $donnees['ID']
                   );
            
            $sql = 'SELECT * FROM membre WHERE ID = :ID AND pseudo = :pseudo AND password = :password AND active = 1';
            $req = $bdd->prepare($sql);
            $req->execute($q);
            $actif = $req->rowCount($sql);
            
            if($actif == 1)
            {
                if (isset($_POST['remember'])) 
                {
                    setcookie('auth', $donnees['ID'] . '---x---' . sha1($pseudo . $hash . $_SERVER['REMOTE_ADDR']), time() + 7*24*3600, '/', false, false);
                }

                $selOP = $bdd->prepare('SELECT OP FROM info_m WHERE ID_m = :ID');
                $selOP->execute(array('ID' => $donnees['ID']));
                $OP = $selOP->fetch();
                
                $token = uniqid(rand(), true);
                $token_time = time();
                
                $_SESSION['Auth'] = array(
                                            'pseudo'     => $pseudo,
                                            'password'   => $hash,
                                            'ID'         => $donnees['ID'],
                                            'OP'         => $OP['OP'],
                                            'token'      => $token,
                                            'token_time' => $token_time
                                           );
                header('Location: ../Compte');
            }
            else
            {
            //Utilisateur non-actif
            $erreur_actif = "Votre compte n'est pas actif, veuillez vérifier vos mails pour activer votre compte";
            $reussite = 0;
            }
        }
        else
        {
            //Utilisateur inconnu
            $erreur_unknown = "Utilisateur inexistant, veuillez créer un compte";
            $reussite = 0;
        }
    }
    else
    {
        $reussite = 0;
    }
}
elseif(!empty($_POST))
{
    $reussite = 0;
}
?>
