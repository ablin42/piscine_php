<?php

$req = $bdd->prepare('SELECT * FROM question AS q
			          INNER JOIN commentaire AS c ON c.ID_m = q.ID_m
			          INNER JOIN reply AS r ON r.ID_m = c.ID_m
			          WHERE q.ID_m = :ID_m
			          ORDER BY q.ID DESC LIMIT 0, 5');
//WHERE q.ID_m OR c.ID_m OR r.ID_m = :ID_m
			          //ORDER BY date DESC LIMIT 0, 5
		$req->execute(array('ID_m' => $donnees['ID']));

while($msg = $req->fetch())
{
	echo'
	<div class="panel panel-primary">
		<div class="panel-body">
			<a href="" style="color: inherit;">'.$msg['question'].'</a>
		</div>

		<div class="panel-footer">
		<a href="" class="panel-footer-icon"><span class="fui-facebook"></span></a>
		<a href="" class="panel-footer-icon"><span class="fui-twitter"></span></a>
		<a href="" class="panel-footer-icon"><span class="fui-google-plus"></span></a>
		<a href="" class="panel-footer-icon" style="float: right;"><span class="fui-export"></span></a>
		</div>

	</div>';
}

?>