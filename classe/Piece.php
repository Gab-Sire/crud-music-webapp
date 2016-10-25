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
