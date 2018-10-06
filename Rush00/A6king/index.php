<?php session_start(); ?>
<!DOCTYPE html>
    <head>
        <link rel="shortcut icon" href="style/images/favicon.ico">
        <title>Asking</title>
        <meta charset="utf-8">
        <script src="style/bootstrap2.0/js/bootstrap.js"  type="text/javascript" ></script>
        <script src="style/Flat-UI-Pro/dist/js/flat-ui-pro.js"  type="text/javascript" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link href="style/bootstrap2.0/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="style/Flat-UI-Pro/dist/css/flat-ui-pro.css" rel="stylesheet" type="text/css">
        <link href="style/index.css" rel="stylesheet" type="text/css">
	    
	<script type="text/javascript" src="style/js/jquery.js"></script><!-- Insertion de la bibliotheque jQuery -->
	<script type="text/javascript" src="style/js/localscroll/jquery.localscroll.js"></script>
	<script type="text/javascript" src="style/js/localscroll/jquery.scrollTo.js"></script>
	<script type="text/javascript" src="style/js/lancement.js"></script>
   </head>
   
<body>
    
    <?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/startheader.php'); ?>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#container-src" data-toggle="tab">Rechercher une question</a></li>
                <li><a href="#container-ask">Poser une question</a></li>
				<li><a href="Liste">Liste des questions</a></li>
				<li><a href="Totale">Interrogation totale (Oui/Non)</a></li>
            </ul>  
    <?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/endheader.html'); ?>
    
<?php include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php'); ?>
<div class="container-fluid horizontal-padding0" id="container-src">

  <!-- Wrapper for slides -->

<?php if (!isset($_GET['c']) OR $_GET['c'] != 1)
{
?>


	    <div class="jumbotron jumbotron-src col-sm-12">
            <h1>Une question? Nous adorons les questions!</h1>
		<p><strong>Mais vérifiez d'abord si elle n'a pas déjà été posée !</strong></p>
		 <!-- jumbotron -->
	    
		    <form method="get" role="search" id="form-src">
			
			<div class="form-group" id="input-src">
			    
			    <input type="hidden" name="c" id="c" value="1" />
			    <div class="col-sm-10 col-sm-offset-1">
			    	<div class="input-group">
			    		<input type="text" class="form-control" name="q" id="q" placeholder="Votre question" style="opacity: 0.9;" />
			    		<span class="input-group-addon">?</span>
			    	</div>
			    </div>
			    
			</div>
			
			    <div class="col-sm-6 col-sm-offset-3" style="margin-top: 20px;"><button type="submit" class="btn btn-primary btn-large btn-block">Rechercher</button></div>
			
		    </form>
		</div>
    
	<?php } else
	{ ?>
	<div class="col-sm-10 col-sm-offset-1">

	<?php if (isset($_GET['q']))
	{include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/functionsrc.php');} ?>
	
	</div>
<?php   } ?>

	<?php $countersrc = $bdd->query('SELECT nombre FROM counter WHERE nom = "src"');
	$countsrc = $countersrc->fetch();?>
	<div class="col-sm-6 col-sm-offset-3 text-center"><h3>Déjà <?php echo $countsrc['nombre'];?> questions recherchées !</h3></div>
    </div>

	
	<div class="divdown">
	<center><a href="#container-ask"><span class="glyphicon glyphicon-chevron-down arrowdown"></span></a></center>
	</div>

    </div>
</div>

    <div class="container-fluid margin20" id="container-ask">
	<div class="jumbotron jumbotron-ask col-sm-12">
	    <h1>Vous n'avez pas trouvé votre réponse :( ?</h1>
	    <p>Alors posez une question et les visiteurs vous répondrons !</p>
	    <center><img src="style/Flat-UI-Pro/docs/assets/img/icons/rocket.svg" /></center>
	
		<form role="form" method="post" action="includes/insertask.php">
		    
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
		    echo'<div>
			<center>
			<p>Veuillez vous inscrire ou vous connecter pour utiliser un pseudo</p>
			    <div class="btn-list" style="padding-right: 50px;"><a class="btn btn-primary btn-lg btncompte" href="Inscription" role="button">S\'inscrire</a></div>
			    <div class="btn-list">OU</div>
			    <div class="btn-list" style="padding-left: 50px;"><a class="btn btn-default btn-lg btncompte" href="Connexion" role="button">Se connecter</a></div>
			<center></div><br />';//echo button connect etc 
		    }
		    ?>
		    
		    <div class="form-group" id="input-ask">
			
			<div class="col-sm-10 col-sm-offset-1">
				<div class="input-group">
					<input type="text" class="form-control" name="ask" id="ask" placeholder="Votre question" />
					<span class="input-group-addon">?</span>
				</div>
			</div>

		    </div>
		    <span class="help-block text-center"><?php if(isset($erreur_q_len)){echo $erreur_q_len;} ?></span>
		    <span class="help-block">La question doit faire plus de 10 caractères !</span>
		    
		    <!--
		    <div class="checkbox col-sm-offset-4 col-sm-4" style="letter-spacing: -0.01em; text-align: center;">
				<label><input type="checkbox" name="totale" id="totale" value="Yes"></label>
		    </div>-->

		    <div class="text-center col-sm-12" style="letter-spacing: -0.01em;">
		    	<p>Cochez si votre question est une interrogation totale (dont la réponse est oui/non)</p>
			    <div class="bootstrap-switch-square">
	                <input type="checkbox" data-label-width="15" data-on-text="<i class='fui-check'></i>" data-off-text="<i class='fui-cross'></i>" data-toggle="switch" name="totale" id="totale" value="Yes"  />
	            </div>
		    </div>

		    <input type="hidden" name="ID_m" id="ID_m" value="<?php if (isset($_SESSION['Auth']) AND isset($_SESSION['Auth']['ID'])) {echo $_SESSION['Auth']['ID'];} else {echo'0';}?>" />
		    
			<div class="col-sm-6 col-sm-offset-3" style="margin-top: 20px;"><button type="submit" class="btn btn-primary btn-large btn-block">Envoyer</button></div>
			
		</form>
		</div>
		
	<?php   $getnbr = $bdd->query('SELECT * FROM question');
			$totalq = $getnbr->rowCount();?>
		
	<div class="col-sm-6 col-sm-offset-3 text-center"><h3>Déjà <?php echo $totalq;?> questions posées !</h3></div>
    </div>
    <?php  if (isset($_GET['r']) AND $_GET['r'] == 0){echo '<div class="alert alert-danger alertmsg" role="alert"><strong>Oops !</strong> La question doit faire plus de 10 caractères !<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>';}?>

<?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/footer.html'); ?>

</body>
</html>
<script src="includes/ask.js"></script>
<!-- switch -->
<script src="style/style/bootstrap-switch/docs/js/jquery.min.js"></script>
<script src="style/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
<script src="style/bootstrap-switch/docs/js/highlight.js"></script>
<script src="style/bootstrap-switch/docs/js/main.js"></script>