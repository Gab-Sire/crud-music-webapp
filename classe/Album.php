<?php

class Album {
	
	private $titre;
	private $imagePochette;
	private $nomArtiste;
	private $nbPieces;
	private $tmpsTotal;
	private $lienArtiste;
	private $listePieces;
	
	public function __construct($titre, $imagePochette, $nomArtiste, $nbPieces, $tmpsTotal, $lienArtiste, $listePieces){
		$this->titre = $titre;
		$this->imagePochette = $imagePochette;
		$this->nomArtiste = $nomArtiste;
		$this->nbPieces = $nbPieces;
		$this->tmpsTotal = $tmpsTotal;
		$this->lienArtiste = $lienArtiste;
		$this->listePieces = $listePieces;
	}
	
	public function getTitre(){
		return $this->titre;
	}
	
	public function setTitre($titre){
		$this->titre = $titre;
	}
	
	public function getImagePochette(){
		return $this->imagePochette;
	}
	
	public function setImagePochette($imagePochette){
		$this->imagePochette = $imagePochette;
	}
	
	public function getNomArtiste(){
		return $this->nomArtiste;
	}
	
	public function setNomArtiste($nomArtiste){
		$this->nomArtiste = $nomArtiste;;
	}
	
	public function getNbPieces(){
		return $this->nbPieces;
	}
	
	public function setNbPieces($nbPieces){
		$this->nbPieces = $nbPieces;
	}
	
	public function getTempsTotal(){
		return $this->tmpsTotal;
	}
	
	public function setTempsTotal($tmpsTotal){
		$this->tmpsTotal = $tmpsTotal;
	}
	
	public function getLienArtiste(){
		return $this->lienArtiste;
	}
	
	public function setLienArtiste($lienArtiste){
		$this->lienArtiste = $lienArtiste;
	}
	
	public function getListePieces(){
		return $this->listePieces;
	}
	
	public function setListePieces($listePieces){
		$this->listePieces = $listePieces;
	}
	
}