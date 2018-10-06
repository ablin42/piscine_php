<?php
	include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');
	extract($_POST);
	$user_ip = $_SERVER['REMOTE_ADDR'];
        $id_question = $_POST['IDq'];
	
        $membrep = $bdd->prepare('SELECT ID_m FROM commentaire WHERE ID = :ID'); //On trouve le ID_m de la personne qui à été upvotée grâce à l'ID_item de l'upvote
        $membrep->execute(array('ID' => $_POST['pageID']));
        $fetch = $membrep->fetch();
        
	// check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
		$dislike_sql = $bdd->prepare('SELECT COUNT(*) FROM rate_com WHERE ip = :ip and id_item = :pageID and rate = 2 ');
		$dislike_sql->execute(array(
						'ip'        => $user_ip,
						'pageID'    => $_POST['pageID']
					));
		        $countdis = $dislike_sql->fetch();
			$dislike_count  = $countdis[0];

		$like_sql = $bdd->prepare('SELECT COUNT(*) FROM rate_com WHERE ip = :ip and id_item = :pageID and rate = 1 ');
		$like_sql->execute(array(
						'ip'        => $user_ip,
						'pageID'    => $_POST['pageID']
					));
		        $countlike = $like_sql->fetch();
			$like_count = $countlike[0];

	if($_POST['act'] == 'like')
	{ //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0))
		{
			$execute = $bdd->prepare('INSERT INTO rate_com (id_item, id_question, ID_m, ip, rate, dt_rated)VALUES(:pageID, :id_question, :ID_m, :ip, "1", NOW())');
			$execute->execute(array(
						'pageID' => $_POST['pageID'],
						'ip'     => $user_ip,
                                                'ID_m' => $fetch['ID_m'],
                                                'id_question' => $id_question
						));
		}
		if($dislike_count == 1)
		{
			$execute = $bdd->prepare('UPDATE rate_com SET rate = 1 WHERE id_item = :pageID AND ip = :ip');
			$execute->execute(array(
						'pageID' => $_POST['pageID'],
						'ip'     => $user_ip
						));
		}

	}
	if($_POST['act'] == 'dislike')
	{ //if the user click on "dislike"
		if(($like_count == 0) && ($dislike_count == 0))
		{
			$execute = $bdd->prepare('INSERT INTO rate_com (id_item, id_question, ID_m, ip, rate, dt_rated)VALUES(:pageID, :id_question, :ID_m, :ip, "2", NOW())');
			$execute->execute(array(
						'pageID' => $_POST['pageID'],
						'ip'     => $user_ip,
                                                'ID_m' => $fetch['ID_m'],
                                                'id_question' => $id_question
						));
		}
		if($like_count == 1)
		{
			$execute = $bdd->prepare('UPDATE rate_com SET rate = 2 WHERE id_item = :pageID AND ip = :ip');
			$execute->execute(array(
						'pageID' => $_POST['pageID'],
						'ip'     => $user_ip
						));
		}
        
	}

        //upvote commentaire question
        $upvote_count = $bdd->prepare('SELECT COUNT(*) FROM rate_com WHERE id_question = :id_question AND id_item = :id_item AND rate = 1'); //On compte le nbr d'upvote par post
        $upvote_count->execute(array(
                                    'id_question' => $id_question,
                                    'id_item' => $pageID
                                    ));
        $countv = $upvote_count->fetch();
        $countvt = $countv[0];
        
        $upvote = $countvt;
        
        $com_upvote = $bdd->prepare('UPDATE commentaire SET upvote = :upvote WHERE ID = :id_item');
        $com_upvote->execute(array(
                                'upvote' => $upvote,
                                'id_item' => $pageID
                                ));
        
        //info_m
        
        $nbrvote = $bdd->prepare('SELECT COUNT(*) FROM rate_com WHERE ID_m = :ID_m AND rate = 1'); //On compte le nombre d'entrée avec l'ID du membre et rate = 1
        $nbrvote->execute(array('ID_m' => $fetch['ID_m']));
        $countv = $nbrvote->fetch();
        $totalv = $countv[0];
        
        $upvote = $bdd->prepare('UPDATE info_m SET upvote = :upvote WHERE ID_m = :ID_m');
        $upvote->execute(array(
                                'upvote' => $totalv,
                                'ID_m' => $fetchid['ID']
                                ));

?>