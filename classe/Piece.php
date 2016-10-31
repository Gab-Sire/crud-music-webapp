<!-- ******************************************************************
	Nom du fichier: 	Piece.php

	Auteur:				Vincent Perrault et Gabriel Cyr
	Date de creation: 	30 octobre 2016
	Cours-Groupe: 		420-323-AL groupe: 1 et 2
	
	But du document:
		Page qui représente la classe Piece de l'Application
********************************************************************  -->
<?php

class Piece {
	
	private $numero;
	private $titre;
	private $duree;
	
	public function __construct($numero, $titre, $duree){
		$this->numero = $numero;
		$this->titre = $titre;
		$this->duree = $duree;
	}
	
	public function getNumero(){
		return $this->numero;
	}
	
	public function setNumero($numero){
		$this->numero = $numero;
	}
	
	
	
	public function getTitre(){
		return $this->titre;
	}
	
	public function setTitre($titre){
		$this->titre = $titre;
	}
	
	public function getDuree(){
		return $this->duree;
	}
	
	public function setDuree($duree){
		$this->duree = $duree;
	}
	
}
?>
