<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Projet combats de coqs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      padding: 15px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
</head>
<body>

<?php
	require 'classes/DB.php';
	$db = new DB();
	session_start();
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"><img src="img/Le_coq_sportif.svg"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Accueil</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li></span> 
        	<?php
				$connecte = $db->isLogged();
				if (!$connecte) {
					echo "<a href=\"connexion.php\">Connexion | Inscription</a>";
				}
				else{
					$menuConnecte = "
						<li><a href=\"compte.php\">{$_SESSION['nomUser']} {$_SESSION['prenomUser']} | Mon compte</a></li>";

					if ($_SESSION['mailUser'] === 'compte.admin@mail.com') {
						$menuConnecte .= "<li><a href=\"admin.php\">Administration</a></li>";
					}

					$menuConnecte .= "<li><a href=\"deconnexion.php\">Déconnexion</a></li>
					
					";
					echo $menuConnecte;
				}
				?>
        </a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="img/combat-de-coqs.jpg" alt="Image">
        <div class="carousel-caption">
          <h3>Combats de coqs</h3>
          <p>Ce site est une parodie d'un site de paris sportifs dans le cadre d'un projet de PHP.</p>
        </div>      
      </div>

      <div class="item">
        <img src="img/maitre_coq.jpg" alt="Image">
        <div class="carousel-caption">
          <!--<h3 style="color: black;">Finale de combat de coqs</h3>-->
          <p style="color: black;">Combats dans le bar du coin de ta rue, tous les vendredis à partir de 20h.</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
	<h1>Bienvenue sur le premier site de combats de coqs !</h1><br>

	<!--<div>
		<div>
			<a href="#"><img src="http://placehold.it/700x400" alt=""></a>
			<div>
				<h4>Item One</h4>
				<h5>$24.99</h5>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
			</div>
		</div>
	</div>-->


  <!--<div class="row">
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Current Project</p>
    </div>
    <div class="col-sm-4"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Project 2</p>    
    </div>
    <div class="col-sm-4">
      <div class="well">
       <p>Some text..</p>
      </div>
      <div class="well">
       <p>Some text..</p>
      </div>
    </div>
  </div>
</div><br>-->
  
  <h2>Présentation</h2>
  <div id="presentation">
    <div id="presentationProjet">
      <h3>Le projet</h3>
      <p>Ce projet a été réalisé pendant le module &laquo;programmation web côté serveur&raquo; dans le cadre d'un projet afin d'évaluer les compétences en PHP. Ce site est une parodie de sites de paris sportifs, l'idée du site étant venue d'une simple blague.</p>
    </div>
    
    <div id="backEnd">
      <h3>La partie Back End</h3>
      <p>Tout le code PHP a été développé par moi-même, comprenant l'inscription et la connexion au site, la connexion à la base de données, l'affichage du contenue de la BDD (affichage des coqs), l'ajout/modification/suppression d'un coq.</p><br>
    </div>
    
    <div id="frontEnd">
      <h3>La partie Front End</h3>
      <p>La partie Front End de ce site a été développée à l'aide d'un template téléchargé sur internet (quelques modifications ont été faites).</p>
    </div>
  </div>

<footer>
  <p>&copy; 2018 - Anthony Duquenoy - DUT Informatique 2<sup>e</sup>année</p>
</footer>

</body>
</html>
