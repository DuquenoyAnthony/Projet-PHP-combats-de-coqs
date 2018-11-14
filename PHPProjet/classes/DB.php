<?php 

class DB
{
	protected $pdo;

	/*----- CONSTRUCTEUR PAR DEFAUT -----*/
	function __construct()
	{
		try{
			$this->pdo = new PDO("pgsql:dbname=test;host=localhost", "anthony", "0000"); 
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	/*----- RETOURNER LE PDO -----*/
	public function getPDO()
	{
		try{
			$pdo = new PDO("pgsql:dbname=test;host=localhost", "anthony", "0000"); //Design pattern singleton
		}
		catch(PDOException $e){
			die($e->getMessage());
		}

		return $pdo;
	}

	/*----- FORMULAIRE D'INSCRIPTION -----*/
	public function inscription()
	{
		?>
		<form action="connexion.php" method="post" class="formInscription">
			<h1>Inscrivez-vous</h1>
		    <div>
		        <label for="nom">Nom*</label></br>
		        <input type="text" name="nomUser" maxlength="20" >
		    </div>
		    <div>
		        <label for="prenom">Prénom*</label></br>
		        <input type="text" name="prenomUser" maxlength="20" >
		    </div>
		    <div>
		    	<label>Date de naissance*</label></br>
		    	<input type="date" name="dateNaissance">
		    </div>
		    <div>
		        <label for="mail">Adresse mail*</label></br>
		        <input type="text" name="mailUser" maxlength="50" >
		    </div>
		    <div>
		        <label for="mdp">Mot de passe* <!--</br>/!\Le mot de passe doit être composé de minimum 8 caractères, dont 1 majuscule, 1 minuscule et 1 chiffre.--></label></br>
		        <input type="password" id="mdp1" name="mdpUser" maxlength="40" >
		    </div>
		    <div>
		        <label for="mdp">Confirmation de mot de passe*</label></br>
		        <input type="password" id="mdp2" name="mdpUser2" maxlength="40" >
		    </div>
		    <div class="button">
		        <button type="submit">S'inscrire</button>
		    </div>
		    <p>*Champs obligatoire</p>
		</form>
		<?php		
		if (isset($_POST['nomUser'])&&isset($_POST['prenomUser'])&&isset($_POST['dateNaissance'])&&isset($_POST['mailUser'])&&isset($_POST['mdpUser'])&&isset($_POST['mdpUser2'])){
			$verifFormulaire = true;
			if(empty($_POST['nomUser'])){
				echo "Vous devez mettre votre nom.</br>";
				$verifFormulaire = false;
			}
			if (empty($_POST['prenomUser'])) {
				echo "Vous devez mettre votre prénom.</br>";
				$verifFormulaire = false;
			}
			if (empty($_POST['dateNaissance'])) {
				echo "Vous devez ajouter une date de naissance.</br>";
				$verifFormulaire = false;
			}
			if (empty($_POST['mdpUser'])&&empty($_POST['mdpUser2'])) {
				echo "Vous devez mettre un mot de passe. </br>";
				$verifFormulaire = false;
			}
			if (!filter_var($_POST['mailUser'], FILTER_VALIDATE_EMAIL)) {
			    echo 'Cet email a un format non adapté.</br>';
			    $verifFormulaire = false;
			}
			if (strlen($_POST['mdpUser']) < 8) {
				echo "Le mot de passe fait moins de 8 caractères";
				$verifFormulaire = false;
			}
			elseif (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#', $_POST['mdpUser'])) {		/*FAIRE REGEX PHP POUR VERIFIER SI MAJ + MIN + CHIFFRE*/
				// preg_match permet de rechercher des caractères dans une chaine donnée (ici dans $_POST['mdpUser'])
				// # délimite le regex / preg_match
				// ^ indique le début de la chaîne
				// (?= ) regarde l'expression donnée après le =
				// . permet de regarder chaque caractère
				// * permet de regarder autant de fois que possible le caractère qui suit
				// [a-z] accepte n'importe quel caractère entre a et z
				echo "Le mot de passe ne respecte pas les critères attendus.";
				$verifFormulaire = false;
			}
			if ($verifFormulaire == true){
				$verifUser = $this->pdo->query("SELECT count(mailUser) from utilisateur where mailUser='{$_POST['mailUser']}';");
				$result = $verifUser->fetchColumn();
				
				if ($result==1) {
					echo "Cette adresse mail est déjà utilisée";
				}
				else{
					if ($_POST['mdpUser']===$_POST['mdpUser2']) {
						
						$nomUser = $_POST['nomUser'];
						$prenomUser = $_POST['prenomUser'];
						$mailUser = $_POST['mailUser'];
						$mdpUser = hash('sha256', $_POST['mdpUser']);
						$dateNaissance = $_POST['dateNaissance'];

						$stmt = $this->pdo->prepare("INSERT INTO utilisateur (nomUser,prenomUser,mailUser,mdpUser,dateNaissance) VALUES (:nom, :prenom, :mail, :mdp, :dateNaiss)");
						$stmt->bindParam(':nom', $nomUser);
						$stmt->bindParam(':prenom', $prenomUser);
						$stmt->bindParam(':mail', $mailUser);
						$stmt->bindParam(':mdp', $mdpUser);
						$stmt->bindParam(':dateNaiss', $dateNaissance);
						try{
							$stmt->execute();
						}
						catch(Exception $e){
							echo "Erreur";
							print_r($e);
						}

						$_SESSION['nomUser'] = $_POST['nomUser'];
						$_SESSION['prenomUser'] = $_POST['prenomUser'];
						$_SESSION['mailUser'] = $_POST['mailUser'];
						header('Location: http://tp.local/PHPProjet/index.php');

					}
					else{
						echo "Le mot de passe est incorrect";
					}
				}
			}
		}
	}

	/*----- CONNECTION BDD -----*/
	public function connexion()
	{		
		?>
		<form action="connexion.php" method="post" class="formConnexion">
			<h1>Connectez-vous</h1>
		    <div>
		        <input type="text" name="mailUser" placeholder="Adresse mail">
		    </div>
		    <div>
		        <input type="password" name="mdpUser" placeholder="Mot de passe">
		    </div>
		    <div class="button">
		        <button type="submit">Se connecter</button>
		    </div>
		</form>
		<?php
		if (isset($_POST['mailUser'])&&isset($_POST['mdpUser'])){
			
			$verifUser = $this->pdo->query("SELECT count(mailUser) from utilisateur where mailUser='{$_POST['mailUser']}';");
			$result = $verifUser->fetchColumn();
			$mdpUser = hash('sha256', $_POST['mdpUser']);

			if ($result==1) {
				$verifMdp = $this->pdo->query("SELECT count(mdpUser) from utilisateur where mdpUser='{$mdpUser}';");
				$resultMdp = $verifMdp->fetchColumn();

				if ($resultMdp==1) {
					
					$requeteNom = $this->pdo->query("SELECT nomUser from utilisateur where mailUser='{$_POST['mailUser']}';");
					$resultNom = $requeteNom->fetch();
					$_SESSION['nomUser'] = $resultNom['nomuser'];

					$requetePrenom = $this->pdo->query("SELECT prenomUser from utilisateur where mailUser='{$_POST['mailUser']}';");
					$resultPrenom = $requetePrenom->fetch();
					$_SESSION['prenomUser'] = $resultPrenom['prenomuser'];

					$_SESSION['mailUser'] = $_POST['mailUser'];
					
					//echo "Bonjour {$_SESSION['prenomUser']} {$_SESSION['nomUser']} !";
					header('Location: http://tp.local/PHPProjet/index.php');
				}
				else
					echo "Mot de passe incorrecte";
			}
			else{
				echo "</br>Adresse mail incorrecte ou inexistante</br>";
			}
		}	
	}

	/*----- RETOURNE FAUX SI L'UTILISATEUR N'EST PAS CONNECTE, VRAI S'IL L'EST -----*/
	public function isLogged(){

		$logged = false;
		if (isset($_SESSION['nomUser'])&& isset($_SESSION['prenomUser'])) {
			$logged = true;
		}

		return $logged;
	}
}

	/*----- AFFICHER CONTENU BDD -----*/
	/*public function afficherTable()
	{
		$requeteNom = "SELECT * from article;";
		$results = $this->pdo->query($requeteNom);
		while ($row = $results->fetch()) {
	    	echo "<h2><a href=\"?id={$row['id']}\">{$row['nom']}</a></h2>";
	    	//echo "<p>{$row['contenu']}</p>";
		}
	}*/


	/*----- SUPPRIMER CONTENU BDD -----*/
	/*public function supprimerAttribut()
	{
		$requeteNom = "SELECT * from article;";
		?><form action="supprimerBDD.php" method="post">
			<input type="radio" name="deleteBDD" value="0" checked><labe0 for="0">Rien</label>
			<?php  
				$stmt=$this->pdo->query($requeteNom);
				while ($row = $stmt->fetch()) {
			    	echo "<input type=\"radio\" name=\"deleteBDD\" value=\"{$row['id']}\"><label for=\"{$row['id']}\">{$row['nom']}</label>";
				}
			?>
			<button type="submit">Supprimer</button>
		</form><?php
	}*/


	/*----- MODIFIER CONTENU BDD -----*/
	/*public function modifierContenu(){
		if (isset($_GET['id'])){
		$requete="SELECT * from article where id={$_GET['id']};";

		//RECUPERER LE NOM DE L'ARTICLE
		$requeteNom = "SELECT nom from article where id={$_GET['id']};";
		$results = $this->pdo->query($requeteNom);
		$nom = $results->fetch()['nom'];
		
		//RECUPERER LE CONTENU DE L'ARTICLE
		$requeteContenu = "SELECT contenu from article where id={$_GET['id']};";
		$results = $this->pdo->query($requeteContenu);
		$contenu = $results->fetch()['contenu'];

		//AFFICHER ARTICLE
		echo "	<h1>Modification dans une BDD</h1>
				<form action=\"modificationBDD.php\" method=\"post\">
	    			<div>
	        			<label for=\"name\">Titre article</label>
	        			<input type=\"text\" id=\"nomArticle\" name=\"nomArt\" value=\"$nom\">
	    			</div>
	    			<div>
	        			<label for=\"msg\">Contenu :</label>
	        			<textarea id=\"msg\" name=\"contenuArt\" rows=\"5\" cols=\"50\">$contenu</textarea>
	    			</div>
	    			<div class=\"button\">
	        			<button type=\"submit\">Enregistrer</button>
	    			</div>
				</form>";
		}
		else{
			echo "<p>Selectionnez ce que vous souhaitez modifier:</p>";
			$this->afficherTable();
		}
	}*/
?>