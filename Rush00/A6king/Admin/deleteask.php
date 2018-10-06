<?php session_start();

include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');

if (isset($_SESSION['Auth']) AND isset($_SESSION['Auth']['pseudo']) AND isset($_SESSION['Auth']['password']) AND isset($_SESSION['Auth']['OP']) //Si la session admin existe on peut delete
    AND $_SESSION['Auth']['OP'] == 1 AND isset($_SESSION['Auth']['ID']) AND isset($_SESSION['Auth']['token']) AND isset($_SESSION['Auth']['token_time']))
{
    if($_SESSION['Auth']['token'] == $_GET['token'])
    {
        //On stocke le timestamp qu'il était il y a 15 minutes
	$timestamp_ancien = time() - (30*60);
	//Si le jeton n'est pas expiré
	if($_SESSION['Auth']['token_time'] >= $timestamp_ancien)
	{
            $finalq = str_replace(' ', '+', $_GET['q']); //pour la function src
            
            $url = 'http://localhost/A6king/';
            $urll = $url . 'liste/'; //On vient de liste
            $urlt = $url . 'totale/'; //On vient de la liste des interro totales
            $urli = $url . '?c=1&q='.$finalq.''; //On vient de la function src de l'accueil
            
            if ($_SERVER['HTTP_REFERER'] == $urll
                OR $_SERVER['HTTP_REFERER'] == $urlt
                OR $_SERVER['HTTP_REFERER'] == $urli)
            {
            $delete = $bdd->prepare('DELETE FROM question WHERE ID = :ID');
            $delete->execute(array(
                                        'ID' => $_GET['ID']
                                        ));
            
                header('Location: '.$_SERVER['HTTP_REFERER'].''); //Puis on redirige
            }
            else
            {
                header('Location: '.$_SERVER['HTTP_REFERER'].'');
            }
        }
        else
        {
	    header('Location: http://localhost/A6king/Compte/logout.php');
        }
    }
    else
    {
	header('Location: '.$_SERVER['HTTP_REFERER'].'');
    }
}
else
{
    header('Location: '.$_SERVER['HTTP_REFERER'].''); //Sinon on redirige
}

?>