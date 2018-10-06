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
        		<li><a href="../Liste">Interrogation totale (Oui/Non)</a></li>
              </ul>  
    <?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/endheader.html'); ?>
    
<?php
include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');

if(isset($_GET['token']) AND isset($_GET['email']))
{
    $token = htmlentities($_GET['token']);
    $email = htmlentities($_GET['email']);

    $q = array(
            'email' => $email,
            'token' => $token
                );
      
    $sql = 'SELECT email, token FROM membre WHERE email = :email AND token = :token';
    $req = $bdd->prepare($sql);
    $req->execute($q);
    $count = $req->rowCount($sql);
    
    if($count == 1)
    {
        $v = array(
                   'email'=> $email,
                   'active'=> '1'
                   );
        //On vérifie si l'utilisateur à activer son compte
        $sql = 'SELECT email, active FROM membre WHERE email = :email AND active = :active';
        $req = $bdd->prepare($sql);
        $req->execute($v);
        $alreadyactive = $req->rowCount($sql);
        
        if($alreadyactive == 1) //Déjà actif
        {
            $erreur_active = "Compté déjà activé !";
        }
        else
        {
            //Sinon on active l'utilisateur
            $u = array(
                       'email'  => $email,
                       'active' => 1
                       );
            
            $sql = 'UPDATE membre SET active = :active WHERE email = :email';
            $req = $bdd->prepare($sql);
            $req->execute($u);
            
            $activated = "Votre compte est désormais actif, vous pouvez vous connecter :)";
        }
    }
    else
    {
        //Utilisateur inconnu
        $prob_token = "Utilisateur non reconnu"; 
    }
}
else
{
    header('Location: ../Inscription');
}

?>
<div class="container-fluid text-center">
<div class="error col-sm-4 col-sm-offset-4"><?php if(isset($activated)){echo '<span class="glyphicon glyphicon-ok glyph-activate" style="color: green;"><p class="glyph-text"><a href="../Connexion" class="glyph-deco">'.$activated.'</a></p></span>';} ?></div>
<div class="error col-sm-4 col-sm-offset-4"><?php if(isset($erreur_active)){echo '<span class="glyphicon glyphicon-hand-down glyph-activate" style="color: orange;"><p class="glyph-text"><a href="../Connexion" class="glyph-deco">'.$erreur_active.'</a></p></span>';} ?></div>
<div class="error col-sm-4 col-sm-offset-4"><?php if(isset($prob_token)){echo '<span class="glyphicon glyphicon-remove glyph-activate" style="color: red;"><p class="glyph-text"><a href="../Inscription" class="glyph-deco">'.$prob_token.'</a></p></span>';} ?></div>   
</div>

<?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/footer.html'); ?>

</body>
</html>