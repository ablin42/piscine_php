<?php  
function getReply($bdd, $donnees, $info, $i) {  
  
    include('votereply.php');
    
    $q = 'SELECT * FROM question AS q
          INNER JOIN commentaire AS c ON c.id_question = q.ID
          INNER JOIN reply AS r ON r.id_reply = c.ID
          WHERE q.ID = '.$_GET['ID'].'';
    $r = $bdd->query($q);
    //'SELECT ID, ID_m, id_reply, contenu, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS datef FROM reply WHERE id_reply = '.$donnees['ID'].' ORDER BY date DESC';
    
    $row = $bdd->prepare('SELECT COUNT(*) FROM reply WHERE id_reply = :id_reply'); //On cherche s'il y a des réponses pour la boucle
    $row->execute(array(
			'id_reply' => $donnees['ID']
			));
    $totalrow = $row->fetch();
    $finalrow = $totalrow[0];
    
    $inforep = $bdd->prepare('SELECT ID_m FROM commentaire WHERE ID = :id_reply'); //pseudo de la personne à qui on répond
    $inforep->execute(array('id_reply' => $donnees['id_reply']));
    $id_rep_m = $inforep->fetch();
    
    $inforeply = $bdd->prepare('SELECT pseudo FROM info_m WHERE ID_m = :ID_m');
    $inforeply->execute(array('ID_m' => $id_rep_m['ID_m']));
    $pseudo = $inforeply->fetch();

    echo '
	<a href="../Utilisateurs/?pseudo='.$info['pseudo'].'" class="media-left pull-left"><img id="'.$donnees['ID'].'" class="img-thumbnail imgcom" src="../image_m/';
	    if ($info['ID_m'] == 0){echo'0000000000000.jpeg" ';}
	    else {echo ''.$info['avatar'].'" ';}
	    echo ' />
	    <p class="text-center">#'.$i.'
	    </p>
	</a>

	<div class="media-body" style="margin: 10px;">
	    <h4 class="pseudo media-heading pull-left">'.$info['pseudo'].'';if($donnees['id_reply'] != 0){echo' => <a href="#'.$donnees['id_reply'].'">'.$pseudo['pseudo'].'</a>';}echo'</h4><br />
	    <em style="color: #C3C3C3;" class="pull-left">Le '.$donnees['date'].'</em><br />
	    <div class="contenu">';
	    if (isset($_SESSION['Auth']) AND isset($_SESSION['Auth']['OP']) AND $_SESSION['Auth']['OP'] == 1)
                {
		    echo '<a href="http://localhost/A6king/Admin/deletecom.php?ID='.$donnees['ID'].'&token='.$_SESSION['Auth']['token'].'&IDQ='.$_GET['ID'].'&rep=1"><span class="glyphicon glyphicon-remove glyphicon remove-admin"></span></a>';
		}
	    echo''.$donnees['contenu'].'</div>
	
        <div class="votecom">
	    <div style="margin-bottom: 4px;" class="btn btn-primary like-btn like-btn'.$donnees['ID'].' '; if($like_count == 1){ echo 'like-h active';} echo '"><span class="glyphicon glyphicon-chevron-up"></span> '.$finallike.'</div>   
            <br />
	    <div class="btn btn-default dislike-btn dislike-btn'.$donnees['ID'].' '; if($dislike_count == 1){ echo 'dislike-h active';} echo '"><span class="glyphicon glyphicon-chevron-down"></span> '.$finaldislike.'</div>
        </div>
	<a href="#comment_form" id="'.$donnees['ID'].'" type="button" class="reply replycom btn btn-primary text-center" aria-expanded="false">Répondre</a>
	</div>';
    /* The following sql checks whether there's any reply for the comment */

    if($finalrow > 0) // there is at least reply
    {  
	while($donnees = $r->fetch())
	{  
        $i++;
	    getReply($bdd, $donnees, $info, $i);  
	}  
    } 
   }
?> 