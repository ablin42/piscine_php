<?php
session_start();
include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');
include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/Connexion/auth.php');

if(Auth::islog())
{
    $req = $bdd->prepare('SELECT * FROM membre WHERE pseudo = :pseudo AND password = :password AND ID = :ID');
    $req->execute(array(
                        'pseudo'    => $_SESSION['Auth']['pseudo'],
                        'password'  => $_SESSION['Auth']['password'],
                        'ID'        => $_SESSION['Auth']['ID']
                        ));
    $donnees = $req->fetch();
    
    $req = $bdd->prepare('SELECT * FROM info_m WHERE ID_m = :ID');
    $req->execute(array(
                        'ID' => $donnees['ID']
                        ));
    $info = $req->fetch();
}
else
{
    header('Location: ../Connexion');
}
?>

<!DOCTYPE html>
    <head>
        <link rel="shortcut icon" href="../style/images/favicon.ico">
        <title>Asking - Mon compte</title>
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
    

<div class="container-fluid horizontal-padding0">
    <div class="col-sm-10 col-sm-offset-1">
        <h2 class="text-center" style="margin-top: 0px;">Profil de <?php echo $donnees['pseudo'];?></h2>
        
        <div class="well col-sm-2">
            <img src="../image_m/<?php echo $info['avatar'];?>" class="img-compte" />
            <ul class="infog-ul">
                <hr /><li>Inscrit le <?php echo $donnees['date_inscription'];?></li>
                <li>e-mail</li>
                <li><a href="#"><span class="fui-facebook" style="font-size: 40px"></span></a></li>
                <li><a href="#"><span class="fui-twitter"  style="font-size: 40px"></span></a></li>
            </ul>
            <hr /><a href="logout.php">Se déconnecter</a>
        </div>

        <div class="well col-sm-6 col-sm-offset-1"> 
            <?php var_dump($_COOKIE); ?>
            <?php var_dump($_SESSION); ?>

            <?php include('lastmsg.php'); ?>
            
        </div>

        <div class="well col-sm-2 col-sm-offset-1">
            <p><?php if ($info['post'] == 1){echo $info['post'].' question posée';} elseif($info['post'] == 0){echo '0 question posée';} else { echo $info['post'].' questions posées';}?> </p>
            <p><?php if ($info['src'] == 1){echo $info['src'].' question recherchée';} elseif($info['src'] == 0){echo '0 question recherchée';} else { echo $info['src'].' questions recherchées';}?></p>
            <p><?php if ($info['reply'] == 1){echo $info['reply'].' réponse proposée';} elseif($info['reply'] == 0){echo '0 réponse proposée';} else { echo $info['reply'].' réponses proposées';}?></p>
            <p><span class="glyphicon glyphicon-chevron-up" style="font-size: 24px; color: #1ABC9C; vertical-align: sub; margin-right: 5px;"></span><?php if($info['upvote'] == 0){echo '0';} else {echo $info['upvote'];}?></p>
        </div>
    </div>
</div>

<?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/footer.html'); ?>

</body>
</html>
