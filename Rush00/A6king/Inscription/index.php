<?php session_start(); ?>
<?php if (isset($_SESSION['Auth']) AND isset($_SESSION['Auth']['ID']))
        {
            header('Location: ../Compte');
        }
?>
<!DOCTYPE html>
    <head>
        <link rel="shortcut icon" href="../style/images/favicon.ico">
        <title>Asking - Inscription</title>
        <meta charset="utf-8">
        <script src="../style/bootstrap2.0/js/bootstrap.js"  type="text/javascript" ></script>
        <script src="../style/Flat-UI-Pro/dist/js/flat-ui-pro.js"  type="text/javascript" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link href="../style/bootstrap2.0/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="../style/Flat-UI-Pro/dist/css/flat-ui-pro.css" rel="stylesheet" type="text/css">
        <link href="../style/index.css" rel="stylesheet" type="text/css">
	    
	<script type="text/javascript" src="../style/js/jquery.js" ></script><!-- Insertion de la bibliotheque jQuery -->
	<script type="text/javascript" src="../style/js/localscroll/jquery.localscroll.js"></script><!-- scroll -->
	<script type="text/javascript" src="../style/js/localscroll/jquery.scrollTo.js"></script>
	<script type="text/javascript" src="../style/js/lancement.js"></script>
        
        <script src='https://www.google.com/recaptcha/api.js'></script><!-- reCaptcha -->
   </head>
   
<body>
    
    <?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/startheader.php'); ?>
              <ul class="nav navbar-nav">
                <li><a href="../#container-src">Rechercher une question</a></li>
                <li><a href="../#container-ask">Poser une question</a></li>
		<li><a href="../Liste">Liste des questions</a></li>
		<li><a href="../Totale">Interrogation totale (Oui/Non)</a></li>
              </ul>  
    <?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/endheader.html'); ?>

<?php include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php'); ?>



<div class="container-fluid">
    
<div class="panel panel-primary col-sm-4 col-sm-offset-4 horizontal-padding0">
    <div class="panel-heading">Inscription <span class="fui-user" style="float: right;"></span></div>
    <div class="panel-body">

        <form role="form" method="post" action="inscriptionform.php" id="inscrire">
    	<div class="form-group">
            
            <label for="pseudo" class="control-label">Pseudonyme</label>
    		<div class="input-group">
    		    <span class="input-group-addon">@</span><input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo" />
    		</div>
    	</div>
            <span class="help-block text-center"><?php if(isset($erreur_pseudo)){echo $erreur_pseudo;}if(isset($erreur_pseudo_pris)){echo $erreur_pseudo_pris;} ?></span>

    	    <div class="form-group"><label for="email" class="control-label">E-mail</label>
                <div><input type="email" class="form-control" name="email" id="email"></div></div>
                <span class="help-block text-center"><?php if(isset($erreur_mail)){echo $erreur_mail;}if(isset($erreur_email_pris)){echo $erreur_email_pris;}  ?></span> 
                
                <div class="form-group"><label for="mdp2" class="control-label">Mot de passe</label>
                <div><input type="password" class="form-control" name="mdp1" id="mdp1"></div></div>
                <span class="help-block text-center"><?php if(isset($erreur_mdp_len)){echo $erreur_mdp_len;} ?></span>    
      
                <div class="form-group"><label for="mdp2" class="control-label">Mot de passe (confirmation)</label>
                <div><input type="password" class="form-control" name="mdp2" id="mdp2"></div></div>
    	    <span class="help-block text-center"><?php if(isset($erreur_mdp)){echo $erreur_mdp;} ?></span>   
        
            <div class="g-recaptcha" data-sitekey="6LdKQf8SAAAAAPytPkW2g4s314_PiJ_shvV_tJ7O"></div>
        
    	<div class="col-xs-8 col-xs-offset-2 margin20"><button type="submit" class="btn btn-primary btn-lg btn-block">Envoyer</button></div>
        </form>

    </div>
    <div class="panel-footer text-center" style="min-height: 50px;">
        Déjà inscrit? <a href="../Connexion"><strong style="color: #34495e">Connectez-vous</strong></a>
    </div>
</div>
</div>

<?php   if (isset($reussite) AND $reussite == 1){echo '<div class="alert alert-success alertmsg" role="alert"><strong>Bravo !</strong> Le mail à bien été envoyé !<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>';}
        if (isset($reussite) AND $reussite == 0){echo '<div class="alert alert-danger alertmsg" role="alert"><strong>Oops !</strong> Corrigez les erreurs et réessayez<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>';}?>

<?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/footer.html'); ?>

</body>
</html>
<script src="inscription.js"></script>