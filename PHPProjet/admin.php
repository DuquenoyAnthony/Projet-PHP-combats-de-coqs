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
  <script type="text/javascript">
  	/*function ajoutCoq() {
		if($("#ajoutCoq").hasClass("active"))
		{
			$(this).removeClass("active");
			$(this).fadeOut();
		}
		else
		{
			$(this).addClass("active");
			$(this).fadeIn();
		}
	}*/
  </script>
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
	require 'classes/COQ.php';
	$db = new DB();
	$pdo = $db->getPDO();
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

<div id="administrer">
		<h1>Administration du site</h1>
		<button onclick="ajoutCoq();">Ajouter un coq</button>
		
		<div id="ajoutCoq">
			<form action="admin.php" method="post">
				<h2>Ajout d'un coq:</h2>
			    <div>
			        <label for="nomCoq">Nom du coq*</label></br>
			        <input type="text" name="nomCoq" maxlength="20" >
			    </div>
			    <div>
			        <label for="nationaliteCoq">Nationalité du coq*</label></br>
			        <select id="natcoq" name="nationaliteCoq">
			        	<option>Français</option>
			        	<option>Anglais</option>
			        	<option>Allemand</option>
			        	<option>Américain</option>
			        </select>
			    </div>
			    <div>
			    	<label for="poidsCoq">Poids du coq*</label></br>
			    	<input type="text" name="poidsCoq">
			    </div>
			        <?php
			        $valide = "*Champs obligatoires";
			        	if (isset($_POST['nomCoq'])&&isset($_POST['nationaliteCoq'])&&isset($_POST['poidsCoq'])){
							if(!empty($_POST['nomCoq'])&&!empty($_POST['nationaliteCoq'])&&!empty($_POST['poidsCoq'])){ 
								$coq = new COQ($_POST['nomCoq'],$_POST['nationaliteCoq'],$_POST['poidsCoq']);
								$coq->saveCoq();
								header('Location: http://tp.local/PHPProjet/admin.php');
							}
							else{
								$valide .= "<br><p style=\"color:red;\">Vous devez compléter tous les champs</p>";
								echo $valide;
							}
						}
						else
							echo $valide;
			        ?>
			    <div class="button">
			        <button type="submit">Ajouter</button>
			    </div>
			</form>
		</div>
</div>
	<?php
		$coqs = COQ::getALL();
		foreach ($coqs as $coq) {
			echo "<div id=\"coq\">";
			echo '<h3>' . $coq['nomcoq'] . '</h3>';
			echo "<p>Poids: ".$coq['poids']."kg";
			echo "<p>Nationalité: ".$coq['nationalitecoq'];
			echo "<p>Catégorie: ".$coq['categoriecoq']."<br>";

			echo "<form action=\"supprimerCoq.php\" method=\"get\">";
			echo "	<input type=\"radio\" name=\"choixCoq\" value=\"modifierCoq\">
					<label for=\"modifierCoq\" >Modifier</label><br>";
			echo "	<input type=\"radio\" name=\"choixCoq\" value=\"supprimerCoq\">
					<label for=\"supprimerCoq\">Supprimer</label><br>
				<button type=\"submit\">Envoyer</button>
			</form>";
			echo "</div>";
		}
	?>

<footer class="container-fluid text-center">
  <p>Copyright &copy; Anthony Duquenoy 2018</p>
</footer>

</body>
</html>
