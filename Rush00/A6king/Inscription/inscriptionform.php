<?php session_start(); ?>
<!DOCTYPE html>
    <head>
        <link rel="shortcut icon" href="../style/images/favicon.ico">
        <title>Asking - Inscription</title>
        <meta charset="utf-8">
        <script src="../style/bootstrap2.0/js/bootstrap.js"  type="text/javascript" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link href="../style/bootstrap2.0/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="../style/bootstrap2.0/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
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
                <li><a href="#container-src">Rechercher une question</a></li>
                <li><a href="#container-ask">Poser une question</a></li>
                <li><a href="#">Liste des questions</a></li>
                <li><a href="#">Interrogation totale (Oui/Non)</a></li>
              </ul>  
    <?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/endheader.html'); ?>

<?php
include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');

if (isset($_POST['g-recaptcha-response'])){$captcha = $_POST['g-recaptcha-response'];}
else {header('Location: ../Inscription');}
    
if(!$captcha)
{
    echo '<h1>Captcha incorrect, veuillez réessayer</h1>';
}

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdKQf8SAAAAAFmFbeBGhzI21dtEMfvzCiz5KXaD&response=".$captcha);
if ($response.'success' == false) 
{
    echo '<h1>Spam détecté</h1>';
}
else
{
    if (!empty($_POST) AND ($_POST['mdp1'] == $_POST['mdp2']) AND strlen($_POST['mdp1']) >= 6 AND strlen($_POST['mdp1']) <= 250 AND strlen($_POST['pseudo']) > 3 
        AND strlen($_POST['pseudo']) <= 50 AND filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) AND strlen($_POST['email']) <= 50)
    {
        $verif = $bdd->prepare('SELECT COUNT(*) FROM membre WHERE pseudo = :pseudo');
        $verif->execute(array('pseudo' => $_POST['pseudo']));
        $verifc = $verif->fetch();
        $verift = $verifc[0];

        if($verift == 0)
        {
            $verife = $bdd->prepare('SELECT COUNT(*) FROM membre WHERE email = :email');
            $verife->execute(array('email' => $_POST['email']));
            $verifem = $verife->fetch();
            $verifemail = $verifem[0];
            
            if($verifemail == 0)
            {
                $string = $_POST['pseudo'];
                $regex = "#^[[:alpha:]' \-]+$#";
                
                $verifsyntax = preg_match($regex, $string);
                
                if($verifsyntax == 1)
                {
            $pseudo = addslashes($_POST['pseudo']);
            $email = addslashes($_POST['email']);
            $password = password_hash($_POST['mdp1'], PASSWORD_DEFAULT);
            $token = password_hash(uniqid(rand()), PASSWORD_DEFAULT);
            
                $req = $bdd->prepare('INSERT into membre (pseudo, email, password, token, date_inscription) VALUES (:pseudo, :email, :password, :token, NOW())');
                $req->execute(array(
                                    'pseudo'   => $pseudo,
                                    'email'    => $email,
                                    'password' => $password,
                                    'token'    => $token
                                    ));
                
                $sel = $bdd->prepare('SELECT ID FROM membre WHERE pseudo = :pseudo AND token = :token');
                $sel->execute(array(
                                    'pseudo' => $pseudo,
                                    'token'  => $token
                                    ));
                $fetch = $sel->fetch();
                
                $req = $bdd->prepare('INSERT into info_m (ID_m, pseudo, email avatar) VALUES (:ID_m, :pseudo, :email, "0000000000000.jpeg")');
                $req->execute(array(
                                    'ID_m' => $fetch['ID'],
                                    'pseudo' => $pseudo,
                                    'email' => $email
                                    ));
              
                //mail de validation du compte
                $to = $email;
                $sujet = "Activation de votre compte A6king";
                $from = "Feedback.A6king@gmail.com";
                $body = '
                Bonjour <strong>'.$pseudo.'</strong>, votre inscription à A6king.com à bien été enregistrée, il ne vous reste plus qu\'a cliquer sur le lien ci dessous afin de l\'activer.<br />
                <a href="http://localhost/A6king/Activate?token='.$token.'&email='.$to.'">Activer votre compte A6king.</a>';
                
                //mail entete
                $entete =
                'De: '.$from."\r\n".
                'Reply-to: '.$from."\r\n".'X-Mailer: PHP/'.phpversion();
                
                mail($to, $sujet, $body, $entete);
                
                $reussite = 1;
                }
                else
                {
                    $erreur_pseudo_pris = "Votre pseudo doit uniquement contenir des caractères alphanumérique.";
                    $reussite = 0;
                }
            }
            else
            {
                $erreur_email_pris = "Cet e-mail est déjà pris !";
                $reussite = 0;
            }
        }
        else
        {
            $erreur_pseudo_pris = "Ce pseudo est déjà pris !";
            $reussite = 0;
        }
    }
    else
    {
        if(!empty($_POST) AND strlen($_POST['pseudo'])<3)
        {
            $erreur_pseudo = "Votre pseudo doit faire au moins 3 caractères !"; 
        }
        
        if(!empty($_POST) AND !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $erreur_mail = "Votre e-mail ne respecte pas la forme demandée !";
        }
        
        if(!empty($_POST) AND ($_POST['mdp1'] != $_POST['mdp2']))
        {
            $erreur_mdp = "Les deux mots de passe ne correspondent pas !";
        }
        
        if(!empty($_POST) AND strlen($_POST['mdp1'])<6)
        {
            $erreur_mdp_len = "Votre mot de passe doit faire plus de 6 caractères !";
        }
        
        if(!empty($_POST))
        {
            $reussite = 0;
        }
    }
}
?>

<?php include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/footer.html'); ?>

</body>
</html>