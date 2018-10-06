<?php
$url = "http://localhost/A6king/";

if (isset($_POST['ID_m']) AND (!empty($_POST['ID_m']) OR $_POST['ID_m'] == 0) AND !empty($_POST['pseudo']) AND strlen($_POST['ask']) >= 10) //Si les champs ont été rempli
{
include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');    

if(isset($_POST['totale']) AND $_POST['totale'] == "Yes") {$tvalue = 1;} else {$tvalue = 0;}

$req = $bdd->prepare('INSERT INTO question (ID_m, pseudo, question, totale, date) VALUES (:ID_m, :pseudo, :question, :totale, NOW())'); //On insère les données
$req->execute(array(
                    'ID_m'       => $_POST['ID_m'],
                    'pseudo'     => $_POST['pseudo'],
                    'question'   => $_POST['ask'],
                    'totale'     => $tvalue
                    )); //On insére les autres informations du formulaire
    
    if(isset($_SESSION['Auth']))
    {    
        $getnbru = $bdd->prepare('SELECT * FROM question WHERE ID_m = :ID_m');
        $getnbru->execute(array('ID_m' => $_SESSION['Auth']['ID']));
        $nbru = $getnbru->rowCount();
        
        $counteru = $bdd->prepare('UPDATE info_m SET post = :post WHERE ID_m = :ID_m');
        $counteru->execute(array(
                                'post' => $nbru,
                                'ID_m' => $_SESSION['Auth']['ID']
                                ));
    }
    else
    {      
        $getnbru = $bdd->query('SELECT * FROM question WHERE ID_m = "0"');
        $nbru = $getnbru->rowCount();
            
        $counteru = $bdd->prepare('UPDATE info_m SET post = :post WHERE ID_m = "0"');
        $counteru->execute(array(
                                'post' => $nbru
                                ));
    }
    
    $redirect = $bdd->prepare('SELECT ID FROM question WHERE ID_m = :ID_m AND question = :question AND date = NOW()');
    $redirect->execute(array(
                            'ID_m' => $_POST['ID_m'],
                            'question' => $_POST['ask']
                            ));
    $IDredirect = $redirect->fetch();
    
    $urlq = $url . 'Question/?ID='.$IDredirect['ID'].'';
    header('Location: '.$urlq.'');
    
}

else
{
    if(!empty($_POST) AND strlen($_POST['ask'])<10)
    {
        $urlr = $url . '?r=0#container-ask';
        header('Location: '.$urlr.'');
    }
    
    if(!empty($_POST))
    {
        $urlr = $url . '?r=0#container-ask';
        header('Location: '.$urlr.'');
    }

}
?>