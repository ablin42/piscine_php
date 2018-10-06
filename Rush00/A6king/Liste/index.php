<?php session_start(); ?>
<!DOCTYPE html>
    <head>
        <link rel="shortcut icon" href="../style/images/favicon.ico">
        <title>Asking</title>
        <meta charset="utf-8">
        <script src="../style/bootstrap2.0/js/bootstrap.js"  type="text/javascript" ></script>
        <script src="../style/Flat-UI-Pro/dist/js/flat-ui-pro.js"  type="text/javascript" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link href="../style/bootstrap2.0/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="../style/Flat-UI-Pro/dist/css/flat-ui-pro.css" rel="stylesheet" type="text/css">
        <link href="../style/index.css" rel="stylesheet" type="text/css">
   </head>
    
<body>
    
        <?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/startheader.php'); ?>
              <ul class="nav navbar-nav">
                <li><a href="../#container-src">Rechercher une question</a></li>
                <li><a href="../#container-ask">Poser une question</a></li>
				<li class="active"><a href="#" data-toggle="tab">Liste des questions</a></li>
				<li><a href="../Totale">Interrogation totale (Oui/Non)</a></li>
              </ul>  
    <?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/endheader.html'); ?>
    
<?php include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php'); ?>
   
    <div class="container-fluid horizontal-padding0" id="container-ask">
	<div class="col-sm-10 col-sm-offset-1">
	    <?php
		if (isset($_GET['pseudo']))
		{
		    $pseudo = addslashes(htmlentities($_GET['pseudo']));
		    $where = $pseudo;
		}
		else
		{
		    $where = '';
		}
		
		if (isset($_GET['ordre']))
		{
		    switch ($_GET['ordre']) // on indique sur quelle variable on travaille
		    {
		    case 'az': //order by az
		    $setordre = "question ASC";
		    break;
		    case 'za': // order by az DESC
		    $setordre = "question DESC";
		    break;
		    case 'qr': // order by date desc
		    $setordre = "date DESC";
		    break;
		    case 'qa': // order by date 
		    $setordre = "date";
		    break;
		    case 'r': //order by nbr rep
		    $setordre = "reply DESC";
		    break;
		    case 'v': //order by nbr vote
		    $setordre = "vote DESC";
		    break;
		    case 'rc': //order by nbr rep
		    $setordre = "reply ASC";
		    break;
		    case 'vc': //order by nbr vote
		    $setordre = "vote ASC";
		    break;
		    default:
		    $setordre = "date DESC";
		    }
		    
		}
		else
		{
		    $setordre = 'date DESC';
		}
		
		if (isset($_GET['limite']))
		{
		    switch ($_GET['limite']) // on indique sur quelle variable on travaille
		    {
		    case '25': 
		    $maxlimit = "25";
		    break;
		    case '50': 
		    $maxlimit = "50";
		    break;
		    case '100': 
		    $maxlimit = "100";
		    break;
		    case '250': 
		    $maxlimit = "250";
		    break;
		    case '500': 
		    $maxlimit = "500";
		    break;
		    default:
		    $maxlimit = "25";
		    }
		}
		else
		{
		    $maxlimit = "25";
		}

		//////////////////////////////////////////////////////////////////////////////////////////////////////

		//On compte le nombre d'entrée correspondant à la catégorie de la page actuelle
			$retour_total = $bdd->query('SELECT COUNT(*) FROM question'); //Nous récupérons le contenu de la requête dans $retour_total
			$resultat = $retour_total->fetch();
			$total = $resultat[0];

		//On calcule le nombre de page nécessaire
			include('../includes/select.php');
			include('../includes/functionpg.php');

		////////////////////////////////////////////////////////////////////////////////////////////////////////

		if(isset($_GET['pseudo']))
		{
			$list = $bdd->prepare('SELECT ID, pseudo, question, totale, DATE_FORMAT(date, \'%d/%m/%Y\') AS datef 
									FROM question WHERE pseudo = :pseudo ORDER BY :setordre LIMIT '.$premiereEntree.', '.$perPagei.'');
			$list->execute(array(
								'pseudo' => $where,
					    		'setordre' => $setordre
					     		));
		}
		else
		{
			$list = $bdd->prepare('SELECT ID, pseudo, question, totale, DATE_FORMAT(date, \'%d/%m/%Y\') AS datef 
								FROM question ORDER BY :setordre LIMIT '.$premiereEntree.', '.$perPagei.'');
			$list->execute(array(
					    		'setordre' => $setordre
					     		));
		}

		
	    echo'<div class="panel panel-primary">
	    <table class="table table-striped table-hover text-left">
                    
                    <div class="panel-heading text-center">
					    <h3 class="vertical-margin0">Liste des questions</h3>
					    
		    		</div>
                                  
            		<div class="panel-body" style="padding: 0px;">                  
                        <tr>
                        <th>Auteur</th>
                        <th>Question</th>
						<th>Nombre de réponses/votes</th>
						<th>Posée le</td>
						<th>Interrogation totale</th>
                        </tr>';
	
        while($donnees = $list->fetch())
            {	
		    $nbrcom = $bdd->prepare('SELECT COUNT(*) FROM commentaire WHERE id_question = :id_question');
		    $nbrcom->execute(array('id_question' => $donnees['ID']));
		    
		    $coms = $nbrcom->fetch();
		    $comst = $coms[0];
		    $insertc = $bdd->prepare('UPDATE question SET reply = :reply WHERE id = :id');
		    $insertc->execute(array(
					    'reply' => $comst,
					    'id' => $donnees['ID']
					    ));
		    
		    $rate_all_count = $bdd->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item = :id_item');
		    $rate_all_count->execute(array('id_item' => $donnees['ID']));
		    
		    $allcount = $rate_all_count->fetch();
		    $finalcount = $allcount[0];
		    $insertv = $bdd->prepare('UPDATE question SET vote = :vote WHERE id = :id');
		    $insertv->execute(array(
					    'vote' => $finalcount,
					    'id' => $donnees['ID']
					    ));
		    
                echo ' 	<tr>
                            <td><strong><a href="?pseudo='.$donnees['pseudo'].'">@'.$donnees['pseudo'].'</a></strong></td>
                            <td style=" max-width: 300px;" class="ellipsis"><a href="http://localhost/A6king/Question?ID='.$donnees['ID'].'">'.$donnees['question'].'?</a></td>
						    <td>'.$comst.' réponses/';if($donnees['totale'] == 1){echo $finalcount;if ($finalcount == 0 OR $finalcount == 1) {echo ' vote';} else {echo ' votes';}} else {echo'Votes désactivés';} echo'</td>
						    <td>'.$donnees['datef'].'</td>
						    <td class="text-center">';
			    if($donnees['totale'] == 1)
			    {
				if (isset($_SESSION['Auth']) AND isset($_SESSION['Auth']['OP']) AND $_SESSION['Auth']['OP'] == 1)
				{
				    echo' <a href="http://localhost/A6king/Admin/deleteask.php?ID='.$donnees['ID'].'
				    &token='.$_SESSION['Auth']['token'].'">
				    <span class="fui-check-circle text-primary" style="font-size: 24px;"></span></a>';
				}
				else
				{
				    echo' <span class="fui-check-circle text-primary" style="font-size: 24px;"></span>';
				}
			    }
			    else
			    {
				if (isset($_SESSION['Auth']) AND isset($_SESSION['Auth']['OP']) AND $_SESSION['Auth']['OP'] == 1)
				{
				    echo' <a href="http://localhost/A6king/Admin/deleteask.php?ID='.$donnees['ID'].'
				    &token='.$_SESSION['Auth']['token'].'">
				    <span class="fui-cross-circle text-primary" style="font-size: 24px;"></span></a>';
				}
				else
				{
				    echo' <span class="fui-cross-circle text-primary" style="font-size: 24px;"></span>';
				}
			    }
			    echo'</td>
                        </tr>';
            }
	echo 	'</table>

		<div class="panel-footer" style="height: 65px;">
		<h3 style="float:left" class="vertical-margin0"><em>'.$total.''; if ($total == 1){echo ' Résultat';} else {echo' Résultats';}echo'</em></h3>
			    <form class="form-inline" method="get" style="float:right;">

									<SELECT class="form-control" name="ordre" id="ordre">
									<OPTION value="az"';if(isset($_GET['ordre']) AND $_GET['ordre'] == 'az'){echo'SELECTED';}echo'>Ordre alphabétique A-Z</OPTION>
									<OPTION value="za"';if(isset($_GET['ordre']) AND $_GET['ordre'] == 'za'){echo'SELECTED';}echo'>Ordre alphabétique Z-A</OPTION>
									<OPTION value="qr"';if((isset($_GET['ordre']) AND $_GET['ordre'] == 'qr') OR !isset($_GET['ordre'])){echo'SELECTED';}echo'>Questions récentes</OPTION>
									<OPTION value="qa"';if(isset($_GET['ordre']) AND $_GET['ordre'] == 'qa'){echo'SELECTED';}echo'>Questions anciennes</OPTION>
									<OPTION value="r"';if(isset($_GET['ordre']) AND $_GET['ordre'] == 'r'){echo'SELECTED';}echo'>Nombre de réponses ></OPTION>
									<OPTION value="v"';if(isset($_GET['ordre']) AND $_GET['ordre'] == 'v'){echo'SELECTED';}echo'>Nombre de votes ></OPTION>
									<OPTION value="rc"';if(isset($_GET['ordre']) AND $_GET['ordre'] == 'rc'){echo'SELECTED';}echo'>Nombre de réponses <</OPTION>
									<OPTION value="vc"';if(isset($_GET['ordre']) AND $_GET['ordre'] == 'vc'){echo'SELECTED';}echo'>Nombre de votes <</OPTION>
									</SELECT>
									
									<SELECT class="form-control" name="limite" id="limite">
									<OPTION value="25"';if(isset($_GET['limite']) AND $_GET['limite'] == '25'){echo'SELECTED';}echo'>Afficher 25 questions</OPTION>
									<OPTION value="50"';if(isset($_GET['limite']) AND $_GET['limite'] == '50'){echo'SELECTED';}echo'>Afficher 50 questions</OPTION>
									<OPTION value="100"';if(isset($_GET['limite']) AND $_GET['limite'] == '100'){echo'SELECTED';}echo'>Afficher 100 questions</OPTION>
									<OPTION value="250"';if(isset($_GET['limite']) AND $_GET['limite'] == '250'){echo'SELECTED';}echo'>Afficher 250 questions</OPTION>
									<OPTION value="500"';if(isset($_GET['limite']) AND $_GET['limite'] == '500'){echo'SELECTED';}echo'>Afficher 500 questions</OPTION>
									</SELECT>
									
									';if (isset($_GET['pseudo'])){echo'<input type="hidden" value="'.$_GET['pseudo'].'" name="pseudo" id="pseudo">';}
									echo'
							
							<button type="submit" class="btn btn-inverse form-control" style="color: #D1D1D1;">Ordonner la liste</button>
			    </div></form>
		</div>
			</div>'; ?>



	</div>
    </div>

<?php
		$numdiv=1;
		//garder les bonnes info url

		$url = '?';
		$first = 0;

		if(isset($_GET['limite']))
		{
			if($first == 0)
			{
				$url .= 'limite='.$_GET['limite'].''; $first++;
			}
			else
			{
				$url .= '&limite='.$_GET['limite'].''; $first++;
			}
		}

		if(isset($_GET['ordre']))
		{
			if($first == 0)
			{
				$url .= 'ordre='.$_GET['ordre'].''; $first++;
			}
			else
			{
				$url .= '&ordre='.$_GET['ordre'].''; $first++;
			}
		}

		if(isset($_GET['pseudo']))
		{
			if($first == 0)
			{
				$url .= 'pseudo='.$_GET['pseudo'].''; $first++;
			}
			else
			{
				$url .= '&pseudo='.$_GET['pseudo'].''; $first++;
			}
		}

		if($first == 0)
		{
			$url .= 'page=';
		}
		else
		{
			$url .= '&page=';
		}



		
		$pagination2 = paginate('', $url, $nbPagei, $cPagei, $numdiv);
	       
		if (isset($pagination2))
		{
			echo $pagination2;
		}
?>

<?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/footer.html'); ?>

</body>
</html>