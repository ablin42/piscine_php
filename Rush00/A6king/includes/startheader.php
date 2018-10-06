    <header>
        <nav class="navbar navbar-inverse navbar-embossed" id="top" role="navigation">
	    
	    <div class="headercompte navbar-right">
		    <?php
		    $url = "http://localhost/A6king/";
		    include (''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');
		    if (!isset($_SESSION['Auth'])) 
		    {
		    	$urli = $url . "Inscription";
		    	$urlc = $url . "Connexion";
			echo'
			<a class="btn btn-primary navbar-btn" href="'.$urli.'" role="button">S\'inscrire</a>
			<a class="btn btn-primary navbar-btn" href="'.$urlc.'" role="button" >Se connecter</a>';
		    }
		    else
		    {
			$info_m = $bdd->prepare('SELECT * FROM info_m WHERE ID_m = :ID_m');
			$info_m->execute(array('ID_m' => $_SESSION['Auth']['ID']));
			$info = $info_m->fetch();
			
			$urlc 	= $url . "Compte";
			$urldc 	= $url . "Compte/logout.php";
			echo'
			<div class="topdivprofile">
			<a class="profiletop" href="'.$urlc.'"><img class="imgtop" src="/A6king/image_m/'.$info['avatar'].'"/></a>
			    <div class="btn-group">
				<button type="button" class="btn btn-primary navbar-btn">'.$info['pseudo'].'</button>
				<button type="button" class="btn btn-primary dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
				  <span class="caret"></span>
				  <span class="sr-only">Toggle Dropdown</span>
				</button>
				<ul class="dropdown-menu" role="menu">
				    <li><a href="'.$urlc.'">Mon compte</a></li>
				    <li class="divider"></li>
				    <li role="presentation" class="dropdown-header">Stats</li>
				    <li><a href="#">Another action</a></li>
				    <li><a href="#">Something else here</a></li>
				    <li class="divider"></li>
				    <li><a href="'.$urldc.'">Se déconnecter</a></li>
				</ul>
			      </div>
			    </div>';
		    }
		    ?>

	    </div>
          <div class="container" style="width:1300px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand brand" href="#" style="font-size: 30px !important">A6K?NG</a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">