<?php session_start(); ?>
<!DOCTYPE html>
    <head>
        <link rel="shortcut icon" href="../style/images/favicon.ico">
        <title>Asking - Question</title>
        <meta charset="utf-8">
        <script src="../style/bootstrap2.0/js/bootstrap.js"  type="text/javascript" ></script>
        <script src="../style/Flat-UI-Pro/dist/js/flat-ui-pro.js"  type="text/javascript" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link href="../style/bootstrap2.0/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="../style/Flat-UI-Pro/dist/css/flat-ui-pro.css" rel="stylesheet" type="text/css">
        <link href="../style/index.css" rel="stylesheet" type="text/css">
            
    <script type="text/javascript" src="../style/js/jquery.js"></script><!-- Insertion de la bibliotheque jQuery -->
	<script type="text/javascript" src="../style/js/localscroll/jquery.localscroll.js"></script>
	<script type="text/javascript" src="../style/js/localscroll/jquery.scrollTo.js"></script>
	<script type="text/javascript" src="../style/js/lancement.js"></script>
   </head>
    
<script type='text/javascript' src='jquery.pack.js'></script>  
<script type='text/javascript'>  
$(function(){  
 $("a.reply").click(function() {  
  var id = $(this).attr("id");  
  $("#id_reply").attr("value", id);  
 });  
});  
</script>

<body>
    
    <?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/startheader.php'); ?>
        <ul class="nav navbar-nav">
            <li><a href="#container-src">Rechercher une question</a></li>
            <li><a href="#container-ask">Poser une question</a></li>
            <li><a href="#">Liste des questions</a></li>
            <li><a href="#">Interrogation totale (Oui/Non)</a></li>
        </ul>  
    <?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/endheader.html'); ?>

<?php include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php'); ?>

    <div class="container-fluid" id="container-ask" style="height: auto;">
	<div class="col-sm-10 col-sm-offset-1 askbox">
    
    <?php   $ID_exist = $bdd->prepare('SELECT EXISTS (SELECT * FROM question WHERE ID = :ID ) AS idexist');
            $ID_exist->execute(array(
                                    'ID' => $_GET['ID']
                                    ));
            $req = $ID_exist->fetch();
            
            	$ID = intval($_GET['ID']);
			  
		$precedent = $bdd->prepare('SELECT * FROM question WHERE ID < :ID ORDER BY ID DESC LIMIT 0, 1');
		$precedent->execute(array(
						  'ID' => $ID
						  ));
		$req = $precedent->fetch();
                
		if ($req)
		{
                    echo '
                    <a class="left carousel-control" href="http://localhost/A6king/Question/?ID='.$req['ID'].'" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>';
		}
		$precedent->closeCursor();
		
		$suivant = $bdd->prepare('SELECT * FROM question WHERE ID > :ID ORDER BY ID LIMIT 0, 1');
		$suivant->execute(array(
						  'ID' => $ID
						  ));
		$req = $suivant->fetch();
		if ($req)
		{
			echo '<a class="right carousel-control" href="http://localhost/A6king/Question/?ID='.$req['ID'].'"" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                  </a>';
		}
  
    ?>
    
	    <?php 
            if (!isset($_GET['ID']) OR (intval($_GET['ID']) <= 0.99 OR is_numeric($_GET['ID']) != TRUE)) //On vérifie le contenu de la variable du get
            {
                    header('location:/');
            }
            else
            {
		$list = $bdd->prepare('SELECT ID, pseudo, question, totale, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS datef FROM question WHERE ID = :ID ORDER BY ID ASC');
		$list->execute(array(
				     'ID' => $_GET['ID']
				     ));
                    
            $donnees = $list->fetch();
                    echo '<h1><em style="color: #16A085;">'.$donnees['pseudo'].' demande :</em></h1>
                    <h4 class="question">'.$donnees['question'].'?</h4>
                    <h5><em>Question posée le: <em style="color: #16A085;">'.$donnees['datef'].'</em></em></h5>';
            } ?>
    

	    <?php
	    if ($donnees['totale'] == 1)
	    {
	    function percent($num_amount, $num_total) {
	    if($num_total == 0) {$num_total = 1;}
	    $count1 = $num_amount / $num_total;
	    $count2 = $count1 * 100;
	    $count = number_format($count2, 0);
	    return $count;}
    
	    include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/getvote.php');
	    echo'
	    <div class="col-sm-6 col-sm-offset-3">
	    <div class="tab-cnt col-sm-3">
		    <div class="btn btn-success like-btn like-btn'.$donnees['ID'].' '; if($like_count == 1){ echo 'like-h active';} echo '">Vote + ('.$finallike.')</div>
	    </div><!-- /tuto-cnt -->
	    
	    
	    <div class="tab-cnt col-sm-4 col-sm-offset-1">
			    <div class="stat-bar hidden-xs" style="margin-top: 15px;">
				<div class="bg-green" style="width:'.$rate_like_percent.'%"></div> <!-- % de like -->
				<div class="bg-red" style="width:'.$rate_dislike_percent.'%"></div> <!-- % de dislike -->
				<p>'.$finalcount.'</p>
			    </div> <!-- stat-bar -->
	    </div>
	    
	    
	    <div class="tab-cnt col-sm-3 col-sm-offset-1"> 
		    <div class="btn btn-danger dislike-btn dislike-btn'.$donnees['ID'].' '; if($dislike_count == 1){ echo 'dislike-h active';} echo '">Vote - ('.$finaldislike.')</div>
	    </div><!-- /tuto-cnt -->

	    </div>';
	    } ?>
	</div>
        
    	<a href="#form_comment" class="col-sm-6 col-sm-offset-3 margin20 btn btn-primary" role="button"> Proposer une réponse</a>
                    
	    <div class="col-sm-10 col-sm-offset-1 margin20">
                <div class="media">
                    <?php

                    $select = $bdd->prepare('SELECT ID, ID_m, contenu, id_question, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS datef FROM commentaire
                                            WHERE id_question = :question ORDER BY upvote DESC');
                    $select->execute(array(
                                           'question' => $_GET['ID']
                                           ));
                    
                    include('functionrep.php');
                    include('functioncom.php');
                    
                    $i = 0;

                    while($donnees = $select->fetch())
                    {
                        $i++;  
                        $info_m = $bdd->prepare('SELECT * FROM info_m WHERE ID_m = :ID_m');
                        $info_m->execute(array(
                                                'ID_m' => $donnees['ID_m']
                                                ));
                        $info = $info_m->fetch();
                        
                        getComments($bdd, $donnees, $info, $i);

                    }
                    ?>
                </div>
		
	    </div>

	    <div class="col-sm-10 col-sm-offset-1"><!-- bloc form commentaire -->

    	<div class="panel panel-primary margin20" id="form_comment">
		<div class="panel-heading"><h2 class="text-center vertical-margin0">Répondre à cette question</h2></div>
           
		<div class="panel-body">
            <form role="form" method="post" action="insertcom.php" id="comment_form">
		    <div class="form-group">
			<div class="col-sm-4 col-sm-offset-4" style="float: none;">
			    <div class="input-group">
			    <div class="input-group-addon">@</div><input type="text" class="form-control" name="pseudo" id="pseudo" <?php if(isset($_SESSION['Auth'])){echo 'value="'.$_SESSION['Auth']['pseudo'].'" readonly';} else {echo 'value="Anonyme" readonly';}?>>
			    </div>
			</div>
		    </div>
                    
                    <?php
		    if (!isset($_SESSION['Auth']))
		    {
		    echo'
			<center>
			<p>Veuillez vous inscrire ou vous connecter pour utiliser un pseudo</p>
			    <div class="btn-list" style="padding-right: 50px;"><a class="btn btn-primary btn-lg btncompte" href="../Inscription" role="button">S\'inscrire</a></div>
			    <div class="btn-list">OU</div>
			    <div class="btn-list" style="padding-left: 50px;"><a class="btn btn-default btn-lg btncompte" href="../Connexion" role="button">Se connecter</a></div>
			<center>';//echo button connect etc 
		    }
		    ?>	     
		    
		    <div class="form-group">
				<div class="col-sm-10 col-sm-offset-1">
					<textarea rows="5" class="form-control" name="contenu" id="contenu" placeholder="Votre réponse ici.."></textarea>
				</div>
		    </div>

			<div class="form-group col-sm-4 col-sm-offset-4">
			  <div class="fileinput fileinput-new text-center margin20" data-provides="fileinput">
			    <span class="btn btn-primary btn-embossed btn-file">
			      <span class="fileinput-new"><span class="fui-upload"></span>  Ajouter un fichier</span>
			      <span class="fileinput-exists"><span class="fui-gear"></span>  Changer</span>
			      <input type="file" name="...">
			    </span>
			    <span class="fileinput-filename"></span>
			    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
			  </div>
			</div>
		    
                    <!-- On prend l'id du membre pour plus tard trouver ses info, on set à 0 si l'utilisateur n'est pas connecté -->
                    <input type="hidden" name="ID_m" id="ID_m" value="<?php if (isset($_SESSION['Auth']) AND isset($_SESSION['Auth']['ID'])) {echo $_SESSION['Auth']['ID'];} else {echo'0';}?>" />
				    <input type="hidden" name="id_reply" id="id_reply" value="0"/>  
				    <input type="hidden" name="question" id="question" value="<?php echo $_GET['ID'];?>">

		    <div class="col-sm-6 col-sm-offset-3"><button type="submit" class="btn btn-primary btn-large btn-block">Envoyer</button></div>
			
		</form>
		</div>
		</div>
	</div>

        </div>
    
<?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/footer.html'); ?>

</body>
</html>