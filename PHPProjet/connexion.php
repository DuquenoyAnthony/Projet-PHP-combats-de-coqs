<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Projet combat coq</title>
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
					$menuConnecte = "<ul> {$_SESSION['prenomUser']} {$_SESSION['nomUser']}
						<li><a href=\"compte.php\">Mon compte</a></li>";

					if ($_SESSION['mailUser'] === 'compte.admin@mail.com') {
						$menuConnecte .= "<li><a href=\"admin.php\">Administration</a></li>";
					}

					$menuConnecte .= "<li><a href=\"deconnexion.php\">Déconnexion</a></li>
					</ul>
					";
					echo $menuConnecte;
				}
				?>
        </a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
	$db->connexion();
	$db->inscription();
?>

<footer class="container-fluid text-center">
  <p>Copyright &copy; Anthony Duquenoy 2018</p>
</footer>

</body>
</html>
