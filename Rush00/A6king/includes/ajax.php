<?php
	include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');
	extract($_POST);
	$user_ip = $_SERVER['REMOTE_ADDR'];
	
	// check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
		$dislike_sql = $bdd->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE ip = :ip and id_item = :pageID and rate = 2 ');
		$dislike_sql->execute(array(
						'ip'        => $user_ip,
						'pageID'    => $_POST['pageID']
					));
		        $countdis = $dislike_sql->fetch();
			$dislike_count  = $countdis[0];

		$like_sql = $bdd->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE ip = :ip and id_item = :pageID and rate = 1 ');
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
			$execute = $bdd->prepare('INSERT INTO wcd_yt_rate (id_item, ip, rate )VALUES(:pageID, :ip, "1")');
			$execute->execute(array(
						'pageID' => $_POST['pageID'],
						'ip'     => $user_ip
						));
		}
		if($dislike_count == 1)
		{
			$execute = $bdd->prepare('UPDATE wcd_yt_rate SET rate = 1 WHERE id_item = :pageID AND ip = :ip');
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
			$execute = $bdd->prepare('INSERT INTO wcd_yt_rate (id_item, ip, rate )VALUES(:pageID, :ip, "2")');
			$execute->execute(array(
						'pageID' => $_POST['pageID'],
						'ip'     => $user_ip
						));
		}
		if($like_count == 1)
		{
			$execute = $bdd->prepare('UPDATE wcd_yt_rate SET rate = 2 WHERE id_item = :pageID AND ip = :ip');
			$execute->execute(array(
						'pageID' => $_POST['pageID'],
						'ip'     => $user_ip
						));
		}

	}
	
?>