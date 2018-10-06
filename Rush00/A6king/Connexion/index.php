<?php session_start();?>
<?php if (isset($_SESSION['Auth']) AND isset($_SESSION['Auth']['ID']))
        {
            header('Location: ../Compte');
        }

include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php'); 
include ('connectform.php');
?>
<!DOCTYPE html>
    <head>
        <link rel="shortcut icon" href="../style/images/favicon.ico">
        <title>Asking - Connexion</title>
        <meta charset="utf-8">
            
        <script src="../style/bootstrap2.0/js/bootstrap.js"  type="text/javascript" ></script>
        <script src="../style/Flat-UI-Pro/dist/js/flat-ui-pro.js"  type="text/javascript" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link href="../style/bootstrap2.0/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="../style/Flat-UI-Pro/dist/css/flat-ui-pro.css" rel="stylesheet" type="text/css">
        <link href="../style/index.css" rel="stylesheet" type="text/css">
	    


	<script type="text/javascript" src="../style/js/jquery.js" ></script><!-- Insertion de la bibliotheque jQuery -->
	<script type="text/javascript" src="../style/js/localscroll/jquery.localscroll.js"></script>
	<script type="text/javascript" src="../style/js/localscroll/jquery.scrollTo.js"></script>
	<script type="text/javascript" src="../style/js/lancement.js"></script>
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


<div class="container-fluid">
    
<div class="panel panel-primary col-sm-4 col-sm-offset-4 horizontal-padding0">
    <div class="panel-heading">Connexion <span class="fui-lock" style="float: right;"></span></div>
    <div class="panel-body">

    <form role="form" method="post" action="">
	<div class="form-group">
            <label for="pseudo" class="control-label">Pseudonyme</label>
	    <div style="margin-bottom: 0px;">
		<div class="input-group">
		    <div class="input-group-addon">@</div><input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
		</div>
	    </div>
	</div>
        <div class="error"><?php if(isset($erreur_actif)){echo $erreur_actif;} ?></div>

            <div class="form-group"><label for="password" class="control-label">Mot de passe</label>
            <div><input type="password" class="form-control" name="password" id="password"></div></div>
            <div class="error"><?php if(isset($erreur_unknown)){echo $erreur_unknown;} ?></div>   
            
            <div class="text-center">
                <p>Connexion automatique</p>
                <div class="bootstrap-switch-square">
                    <input type="checkbox" data-label-width="15" data-on-text="<i class='fui-check'></i>" data-off-text="<i class='fui-cross'></i>" data-toggle="switch" name="remember" id="remember"  />
                </div>
            </div>
    
	<div class="col-sm-8 col-sm-offset-2 margin20"><button type="submit" class="btn btn-primary btn-large btn-block">Envoyer</button></div>

    </form> 

    <div class="btn-block btn-group margin20" role="group">
    <a role="button" class="btn btn-default" href="../Inscription" style="width:50%;">S'inscrire</a>
    <a role="button" class="btn btn-primary" href="#reset" style="width:50%;">Mot de passe oublié?</a>
    </div>
       
    </div>
</div>
</div>

<?php
    if (isset($reussite) AND $reussite == 1){echo '<div class="alert alert-success alertmsg" role="alert"><strong>Bravo !</strong> Le mail à bien été envoyé !<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>';}
    if (isset($reussite) AND $reussite == 0){echo '<div class="alert alert-danger alertmsg" role="alert"><strong>Oops !</strong> Corrigez les erreurs et réessayez<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>';}
?>

<?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/footer.html'); ?>

</body>
</html>

<!-- switch -->
<script src="../style/style/bootstrap-switch/docs/js/jquery.min.js"></script>
<script src="../style/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
<script src="../style/bootstrap-switch/docs/js/highlight.js"></script>
<script src="../style/bootstrap-switch/docs/js/main.js"></script>