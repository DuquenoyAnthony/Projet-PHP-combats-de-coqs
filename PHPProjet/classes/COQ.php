<?php

class COQ 
{
	protected $nomCoq;
	protected $nationaliteCoq;
	protected $poidsCoq;
	protected $categorieCoq;

	/*---- Initialise les données du coq ----*/
	function __construct($nomCoq, $nationaliteCoq, $poidsCoq)
	{
		$this->nomCoq = $nomCoq;
		$this->nationaliteCoq = $nationaliteCoq;
		$this->poidsCoq = $poidsCoq;

		if ($poidsCoq<=2) {
			$this->categorieCoq = 'poids leger';
		}
		elseif (($poidsCoq<5)&&($poidsCoq>2)) {
			$this->categorieCoq = 'poids normal';
		}
		else{
			$this->categorieCoq = 'poids lourd';
		}
	}

	/*---- Ajoute le coq dans la BDD ----*/
	public function saveCoq()
	{
		$stmt = DB::getPDO()->prepare("INSERT INTO coq (nomcoq, nationalitecoq,poids,categoriecoq) VALUES (:nom, :nationalite, :poids, :categorie)");
		$stmt->bindParam(':nom', $this->nomCoq);
		$stmt->bindParam(':nationalite', $this->nationaliteCoq);
		$stmt->bindParam(':poids', $this->poidsCoq);
		$stmt->bindParam(':categorie', $this->categorieCoq);
		$stmt->execute();
	}

	//public function modifierCoq();

	public function supprimerCoq($nom)
	{
		$stmt = DB::getPDO()->prepare("DELETE FROM coq WHERE nomCoq=:nomcoq");
		$stmt->bindParam(':nom', $nom);
		$stmt->execute();
	}

	public static function getAll() {
		$pdo = DB::getPDO();
		//$coqs = array('nom','nationalite','poids','photo','categorie');

		$stmt = $pdo->prepare("SELECT * FROM coq");
		$stmt->execute();

		$coqs = $stmt->fetchAll();
		return $coqs;
	}

}
?>