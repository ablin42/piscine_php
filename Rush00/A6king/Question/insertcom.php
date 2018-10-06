<?php
session_start();
include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');

if((!empty($_POST['ID_m']) OR $_POST['ID_m'] == 0) AND strlen($_POST['contenu']) >= 10 AND !empty($_POST['question']))
{

    if (preg_match("#http(s)://www|www.youtube.com/watch?v=[0-9A-Za-z.-_]{1,}#",$_POST['contenu']))
    {
        $contenuslashes = addcslashes($_POST['contenu'], '?');
        $pattern = 'watch\?v=';
        $replacement = 'embed/';
        $string = ''.$contenuslashes.'';
        $contenu = str_replace($pattern, $replacement, $string);
    }

    if(isset($_FILES))
    {
        if ($_POST['id_reply'] == 0)
        {
            $addcom = $bdd->prepare('INSERT INTO commentaire (ID_m, contenu, id_question, date) VALUES (:ID_m, :contenu, :question, NOW())');
            $addcom->execute(array(
                                   'ID_m' => $_POST['ID_m'],
                                   'contenu' => $contenu,
                                   'question' => $_POST['question']
                                   ));
        }
        elseif (!empty($_POST['id_reply']) AND $_POST['id_reply'] != 0)
        {
            $addcom = $bdd->prepare('INSERT INTO reply (ID_m, id_reply, contenu, date) VALUES (:ID_m, :id_reply, :contenu, NOW())');
            $addcom->execute(array(
                                   'ID_m' => $_POST['ID_m'],
                                   'id_reply' => $_POST['id_reply'],
                                   'contenu' => $contenu
                                   ));
        }
    }
    else
    {
        if ($_POST['id_reply'] == 0)
        {
            $addcom = $bdd->prepare('INSERT INTO commentaire (ID_m, contenu, id_question, date) VALUES (:ID_m, :contenu, :question, NOW())');
            $addcom->execute(array(
                                   'ID_m' => $_POST['ID_m'],
                                   'contenu' => $contenu,
                                   'question' => $_POST['question']
                                   ));
        }
        elseif (!empty($_POST['id_reply']) AND $_POST['id_reply'] != 0)
        {
            $addcom = $bdd->prepare('INSERT INTO reply (ID_m, id_reply, contenu, date) VALUES (:ID_m, :id_reply, :contenu, NOW())');
            $addcom->execute(array(
                                   'ID_m' => $_POST['ID_m'],
                                   'id_reply' => $_POST['id_reply'],
                                   'contenu' => $contenu
                                   ));
        }
    }
    
    if(isset($_SESSION['Auth']))
    {
    $getnbru = $bdd->prepare('SELECT * FROM commentaire WHERE ID_m = :ID_m');
    $getnbru->execute(array('pseudo' => $_SESSION['Auth']['ID']));
    $rownbru = $getnbru->rowCount();
    
    $counteru = $bdd->prepare('UPDATE info_m SET reply = :reply WHERE ID_m = :ID_m');
    $counteru->execute(array(
                            'reply' => $rownbru,
                            'ID_m'  => $_SESSION['Auth']['ID']
                            ));
    }
    else
    {     
        $getnbru = $bdd->query('SELECT * FROM commentaire WHERE ID_m = "0"');
        $rownbru = $getnbru->rowCount();
        
        $counteru = $bdd->prepare('UPDATE info_m SET reply = :reply WHERE ID_m = "0"');
        $counteru->execute(array(
                                'reply' => $rownbru
                                ));
    }

    header('Location: '.$_SERVER['HTTP_REFERER'].'');
}
else
{
    header('Location: '.$_SERVER['HTTP_REFERER'].'');
}
?>