<?php
include 'classe/Album.php';
include 'classe/Piece.php';
include 'Modele.php';

class AlbumModele extends Modele {
	
	public $albums;
	
	public function __construct(){
		
		$this->albums = array();
		$fileIn = fopen("./data/listeAlbums.txt", 'r');
		
		if($fileIn){

			while(($line = fgets($fileIn)) !== false){
				
				$tab = explode("|", $line);			//tableau des données du fihier texte 
				$nbPieces = $tab[4];				//nombre de pièces selon l'éément 4 du tableau
				$listePieces = array();				//tableau des pièces à venir
				$tmpsSecondes = 0;					//temps total en secondes de l'album à venir
				
				/*	boucle pour obtenir les pièces et le temps total des pièces */
				for($i = 0; $i < $nbPieces; $i++){
					
					//crée l'objet Pièce et l'insère dans la liste
					$listePieces[] = new Piece($i+1, $tab[6 + (2*$i)],$tab[5 + (2*$i)]);
					
					//définit le temps total des pièces en secondes
					$duree = explode(":", $tab[5 + (2*$i)]);
					$tmpsSecondes += $duree[0]*60;
					$tmpsSecondes += $duree[1];
				}
				
				//formatte le temps en secondes en temps de durée total 
				$minutes = intval($tmpsSecondes/60);
				$secondes = $tmpsSecondes%60;
				$tmpsTotal = ($minutes . ":" . $secondes);
				
				//crée l'objet Album avec tous ses champs
				$this->albums[] = new Album($tab[1],$tab[2], $tab[0], $nbPieces, $tmpsTotal, $tab[3], $listePieces);
				
			}
			fclose($fileIn);
		}	
	}
	
	public function getAll(){
		return $this->albums;
	}
	
	public function getById($id){
		return ($this->albums[$id]);
	}
	
	public function creer($album){
		$this->albums[] = $album;
	}
	
	public function recherche($expression){
	
		$tableauExpressionsTrouves = array();
	
		//élément 0 du tableau possède l'expression en texte pour passer au contrôleur
		$tableauExpressionsTrouves[] = $expression;
	
		$expression = "#". $expression . "#i";
		//élément 1 du tableau possède l'expression en pattern pour passer au contrôleur
		$tableauExpressionsTrouves[] = $expression;
	
		//découpe le fichier texte en tableau de données selon les délimiteurs | et saut de ligne
		$tableauDonnees = preg_split( "/[\|\\n]/", file_get_contents("./data/listeAlbums.txt"));
	
		foreach($tableauDonnees as $donnee){
			if(preg_match($expression, $donnee))
				$tableauExpressionsTrouves[] = $donnee;
		}
	
		//élimine les éléments dupliqués du tableau
		$tableauExpressionsTrouves = array_unique($tableauExpressionsTrouves);
	
		return $tableauExpressionsTrouves;
	}
	
	public function supprimeAlbum($album){
		unset($album);
	}
	
	public function validationTitreAlbum($titre){
		return preg_match("/^[a-zA-Z]{1,40}$/", trim($titre));
	}
	
	public function validationArtisteAlbum($artiste){
		return preg_match("/^[a-zA-Z]{1,40}$/", trim($artiste));
	}
	
	public function validationUrlArtiste($url){
		return preg_match("/^([\da-z\.-]+)\.([a-z\.]{2,6})$/", trim($url));
	}
	
	public function validationImagePochette($imagePochette){
		return ($imagePochette['name'] != "");
	}
}

?>