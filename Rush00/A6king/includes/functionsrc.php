<?php
if (isset($_GET['q']))
{
    $getnbr = $bdd->query('SELECT * FROM counter WHERE nom = "src"');
    $rownbr = $getnbr->fetch();
    $nbr = $rownbr['nombre'] + 1;
    
    $counter = $bdd->prepare('UPDATE counter SET nombre = :nombre WHERE nom = "src"');
    $counter->execute(array('nombre' => $nbr));
    
    if(isset($_SESSION['Auth']))
    {
    $req = $bdd->prepare('SELECT ID FROM membre WHERE pseudo = :pseudo');
    $req->execute(array('pseudo' => $_SESSION['Auth']['pseudo']));
    $donnees = $req->fetch();
    $ID_m = $donnees['ID'];
    
    $getnbru = $bdd->prepare('SELECT src FROM info_m WHERE ID_m = :ID_m');
    $getnbru->execute(array('ID_m' => $ID_m));
    $rownbru = $getnbru->fetch();
    $nbru = $rownbru['src'] + 1;
    
    $counteru = $bdd->prepare('UPDATE info_m SET src = :src WHERE ID_m = :ID_m');
    $counteru->execute(array(
                             'ID_m' => $ID_m,
                             'src' => $nbru
                             ));
    }
    else
    {

    }


    $keywords = array_filter(
    explode(' ', $_GET['q']),
    function ($v) {
        return strlen($v) > 3;
    }
    );
    
    $where = '';
    if ($keywords) {
    $where = ' WHERE ' . implode(
        ' OR ',
        array_map(
            function ($v) use ($bdd) {
                return 'question LIKE ' . $bdd->quote('%' . $v . '%');
            },
            $keywords
        )
    );
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
            $setordre = "ID";
            }
            
        $ordre = 'ORDER BY '.$setordre.'';
        }
        else
        {
            $ordre = '';
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

    $retour_total = $bdd->query('SELECT COUNT(*) FROM question '.$where.''); //Nous récupérons le contenu de la requête dans $retour_total
    $resultat = $retour_total->fetch();
    $total = $resultat[0];

    //On calcule le nombre de page nécessaire
    include('select.php');
    include('functionpg.php');

//////////////////////////////////////////////////////////////////////////////////////////////////////

$req = $bdd->query('SELECT ID, pseudo, question, totale, DATE_FORMAT(date, "%d/%m/%Y") AS datef FROM question
                    '.$where.' '.$ordre.' LIMIT '.$premiereEntree.', '.$perPagei.'');
    
    $where = '';
    if ($keywords) {
    $where = ' WHERE ' . implode(
        ' OR ',
        array_map(
            function ($v) use ($bdd) {
                return 'question LIKE ' . $bdd->quote('%' . $v . '%');
            },
            $keywords
        )
    );
    }
$countreq = $bdd->query('SELECT COUNT(*) FROM question '.$where.'');
$countf = $countreq->fetch();
$countfinal = $countf[0];
        
        if ($countfinal != 0)
        {
        echo '<div class="panel panel-primary">
        <table class="table table-striped table-hover" style="text-align:left;">

        <div class="panel-heading text-center">
                    <h3 class="vertical-margin0">Liste des questions correspondants à votre recherche</h3>
        </div>

                    <div class="panel-body" style="padding: 0px;">     
                        <tr>
                        <th>Auteur</th>
                        <th>Question</th>
            			<th>Nombre de réponses/votes</th>
            			<th>Posée le</td>
            			<th>Interrogation totale</th>
                        </tr>';
                    
        while($donnees = $req->fetch())
            {	
		    $nbrcom = $bdd->prepare('SELECT COUNT(*) FROM commentaire WHERE id_question = :id_question');
                    $nbrcom->execute(array('id_question' => $donnees['ID']));
		    $coms = $nbrcom->fetch();
		    $comst = $coms[0];
		    
		    $rate_all_count = $bdd->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item = :id_item');
                    $rate_all_count->execute(array('id_item' => $donnees['ID']));
		    $allcount = $rate_all_count->fetch();
		    $finalcount = $allcount[0];
		    
                echo ' 	<tr>
                            <td><strong>@'.$donnees['pseudo'].'</strong></td>
                            <td style=" max-width: 300px;" class="ellipsis"><a href="../Question?ID='.$donnees['ID'].'">'.$donnees['question'].'?</a></td>
            			    <td>'.$comst.' réponses/';if($donnees['totale'] == 1){echo $finalcount;if ($finalcount == 0 OR $finalcount == 1) {echo ' vote';} else {echo ' votes';}} else {echo'Votes désactivés';} echo'</td>
            			    <td>'.$donnees['datef'].'</td>
            			    <td>';
                            if($donnees['totale'] == 1)
                            {
                                if (isset($_SESSION['Auth']) AND isset($_SESSION['Auth']['OP']) AND $_SESSION['Auth']['OP'] == 1)
				{
				    echo' <a href="http://localhost/A6king/Admin/deleteask.php?ID='.$donnees['ID'].'
				    &token='.$_SESSION['Auth']['token'].'&q='.$_GET['q'].'">
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
				    &token='.$_SESSION['Auth']['token'].'&q='.$_GET['q'].'">
				    <span class="fui-cross-circle text-primary" style="font-size: 24px;"></span>';
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

        <div class="panel-footer" style="height: 75px">
            <h3 class="vertical-margin0" style="float:left;"><em>'.$countfinal.''; if ($countfinal == 1){echo ' Résultat';} else {echo' Résultats';}echo'</em></h3>

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
        </div>';

}
        else
        {echo '<h3 style="color: #1ABC9C;"><em>'.$countfinal.' Résultat</em></h3>';}
        
        if ($countfinal == 0)
        {
        ?>
        <div class="jumbotron jumbotron-ask col-sm-12">
                <h1>Aucune question ne correspond à votre recherche</h1>
                <div class="btn-list" style="padding-right: 50px;"><p><a class="btn btn-primary btn-lg" href="#container-ask" role="button" style="width: 235px;">Poser une question</a></p></div>
                <div class="btn-list"><strong>OU</strong></div>
                <div class="btn-list" style="padding-left: 50px;"><p><a class="btn btn-default btn-lg" href="../A6king" role="button" style="width: 235px;">Rechercher une question</a></p></div>
        </div>
        <?php
        }
        else
        {
        ?>      <center>
                <div class="btn-list" style="padding-right: 50px;"><p><a class="btn btn-primary btn-lg" href="#container-ask" role="button" style="width: 235px;">Poser une question</a></p></div>
                <div class="btn-list"><strong>OU</strong></div>
                <div class="btn-list" style="padding-left: 50px;"><p><a class="btn btn-default btn-lg" href="../A6king" role="button" style="width: 235px;">Rechercher une question</a></p></div>
                </center>
            </div>
        <?php
        }

//////PAGINATION//////

        $numdiv=1;
        //garder les bonnes info url

        $url = '?';
        $first = 0;

        if(isset($_GET['c']))
        {
            if($first == 0)
            {
                $url .= 'c='.$_GET['c'].''; $first++;
            }
            else
            {
                $url .= '&c='.$_GET['c'].''; $first++;
            }
        }

        if(isset($_GET['q']))
        {
            if($first == 0)
            {
                $url .= 'q='.$_GET['q'].''; $first++;
            }
            else
            {
                $url .= '&q='.$_GET['q'].''; $first++;
            }
        }

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

////// END PAGINATION//////

        
        
}
?>