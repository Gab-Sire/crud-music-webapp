<!-- ******************************************************************
	Nom du fichier: 	AlbumModele.php

	Auteur:				Vincent Perrault et Gabriel Cyr
	Date de creation: 	30 octobre 2016
	Cours-Groupe: 		420-323-AL groupe: 1 et 2
	
	But du document:
		Page qui représente le modele pour les albums de l'application
********************************************************************  -->
<?php
include 'classe/Album.php';
include 'classe/Piece.php';
include 'Modele.php';

/**
 * Classe représentant le modèle des albums
 * @author Gabriel Cyr et Vincent Perraut
 *
 */
class AlbumModele extends Modele {
	
	public $albums;
	
	/**
	 * Constructeur de la classe AlbumModele
	 */
	public function __construct(){
		
		$this->albums = array();
		$fileIn = fopen("./data/listeAlbums.txt", 'r');
		
		if($fileIn){

			while(($line = fgets($fileIn)) !== false && $line != ""){
				
				$tableauDonnees = explode("|", $line);			//tableau des données du fichier texte 
				$nbPieces = $tableauDonnees[4];				//nombre de pièces selon l'élément 4 du tableau
				$listePieces = array();				//tableau des pièces à venir
				$tmpsSecondes = 0;					//temps total en secondes de l'album à venir
				
				/*	boucle pour obtenir les pièces et le temps total des pièces */
				for($i = 0; $i < $nbPieces; $i++){
					
					//crée l'objet Pièce et l'insère dans la liste
					$listePieces[] = new Piece($i+1, $tableauDonnees[6 + (2*$i)],$tableauDonnees[5 + (2*$i)]);
					
					//définit le temps total des pièces en secondes
					$duree = explode(":", $tableauDonnees[5 + (2*$i)]);
					$tmpsSecondes += $duree[0]*60;
					$tmpsSecondes += $duree[1];
				}
				
				//formatte le temps en secondes en temps de durée total 
				$minutes = intval($tmpsSecondes/60);
				$secondes = $tmpsSecondes%60;
				$tmpsTotal = ($minutes . ":" . $secondes);
				
				//crée l'objet Album avec tous ses champs
				$this->albums[] = new Album($tableauDonnees[1],$tableauDonnees[2], $tableauDonnees[0], $nbPieces, $tmpsTotal, $tableauDonnees[3], $listePieces);
			}
			fclose($fileIn);
		}	
	}
	
	/**
	 * Fonction qui permet de retourner tous les albums
	 */
	public function getAll(){
		return $this->albums;
	}
	
	/**
	 * Fonction qui permet de retourner un album selon son id
	 * 
	 * @param $id l'identifiant de l'album (son index dans le tableau d'albums)
	 * @return album
	 */
	public function getById($id){
		return ($this->albums[$id]);
	}
	
	/**
	 * Fonction qui permet de retourner un album selon nom titre
	 * 
	 * @param $titre le titre de l'album
	 * @return album
	 */
	public function getByTitre($titre){
		
		//itère sur tous les albums jusqu'à ce que le titre corresponde
		foreach($this->albums as $album){
			if($album->getTitre() == $titre)
				return $album;
		}
	}
	
	/**
	 * Fonction qui permet d'aller chercher la liste des pièces des champs pour les pièces de l'album
	 * 
	 * @param $titres les titres des pièces de l'album dans l'ajout
	 * @param $durees les durees des pièces de l'album dans l'ajout
	 */
	public function getListePieces($titres, $durees){
		$listePieces = array();
		for ($i=0; $i<count($titres); $i++){
			if($titres[$i] != '' && $durees[$i] != '')
				$listePieces[] =  trim($durees[$i])."|".trim($titres[$i]);
		}
		return $listePieces;
	}
	
	/**
	 * Fonction qui permet de créer un album supplémentaire dans le tablelau d'albums
	 * 
	 * @param $listePiece la liste des pieces totales de l'album à creer
	 */
	public function ajouter($listePieces){
		
		// Déplacement de l'image dans le bon répertoire
		$repertoireImages = "./images";
		$nomFichier = $_FILES['imagePochette']['name'];
		
		//booléen pour exécuter un téléversement avec un nomde fichier modifié ou non
		$uploadModifie = false;
		
		foreach($this->albums as $album){
			
			//si le nom du fichier d'image existe déjà en tant qu'image pochette, modifie le nom du fichier image en lui ajoutant 1 avant l'extension
			if($album->getImagePochette() == $nomFichier){
				
				$uploadModifie = true;
				
				//tableau séparant le nom du fichier de l'extension
				$tableauNomFichier = explode(".", $nomFichier);
				
				//le téléversement se fait avec le nom modifié, le nom modifié se retrouve aussi dans le fichier texte
				move_uploaded_file ($_FILES['imagePochette']['tmp_name'],"$repertoireImages/$tableauNomFichier[0]1.$tableauNomFichier[1]");
				$_FILES['imagePochette']['name'] = "$tableauNomFichier[0]1.$tableauNomFichier[1]";
			}
		}
		
		if($uploadModifie == false)
			move_uploaded_file ($_FILES['imagePochette']['tmp_name'],"$repertoireImages/$nomFichier");
		
		// Écriture dans le fichier
		$monFichier = fopen("./data/listeAlbums.txt", 'a') or die("Unable to open file!");
		$txt = $_POST['artiste']."|".$_POST['titreAlbum']."|".$_FILES['imagePochette']['name']."|".$_POST['urlArtiste']."|".count($listePieces)."|";
		for($i=0; $i<count($listePieces); $i++){
			$txt.=$listePieces[$i]."|";
		}
		if($i == count($listePieces)-1)
			$txt.=$listePieces[$i];
		fwrite($monFichier, "\n".$txt);
		fclose($monFichier);
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
	
	/**
	 * Fonction qui permet de supprimer un album
	 * 
	 * @param $album l'album à supprimer
	 * @param $id l'identifiant de l'album
	 */
	public function supprimeAlbum($album, $id){
		
		//detruit le fichier d'image de pochette de l'album
		unlink("images/" . $album->getImagePochette());
		
		//sépare le contenu du fichier texte de data ligne par ligne et affiche une string vide pour la pigne de l'album à supprimer
		$file = file_get_contents("./data/listeAlbums.txt");
		$data = explode("\n", $file);
		$data[$id-$nbAlbumsSupprimes] = "";
		
		$fileOut = fopen("./data/listeAlbums.txt", "w");
		file_put_contents("./data/listeAlbums.txt", "");
		
		foreach($data as $line){
			if($line !== "")
				fputs($fileOut, "$line" ."\n");
		}	
	
	
	}
	
	/**
	 * Fonction qui permet de trier une liste de pièces selon leur numéro
	 * 
	 * @param $liste la liste à trier 
	 * @param $ordre l'ordre selon lequel trier (croissant ou décroissant)
	 * @return $liste la liste triée
	 */
	public function trierListeNumero($liste, $ordre){
		
		//fonction de comparaison pour trier selon l'ordre croissant
		function triageNumeroCroissant($a, $b){
			if($a->getNumero() == $b->getNumero())
				return 0;
			return $a->getNumero()-$b->getNumero();
		}
		
		//fonction de comparaison pour trier selon l'ordre décroissant
		function triageNumeroDecroissant($a, $b){
			if($a->getNumero() == $b->getNumero())
				return 0;
			return $b->getNumero()-$a->getNumero();
		}
		
		//choisir la bonne fonction de comparaison selon l'ordre choisi et trier la liste par valeur
		$triage = ($ordre == 'croissant') ? 'triageNumeroCroissant' : 'triageNumeroDecroissant';
		usort($liste, $triage);
		return $liste;
	}
	
	/**
	 * Fonction qui permet de trier une liste de pièces selon leur durée
	 *
	 * @param $liste la liste à trier
	 * @param $ordre l'ordre selon lequel trier (croissant ou décroissant)
	 * @return $liste la liste triée
	 */
	public function trierListeDuree($liste, $ordre){
		
		//fonction de comparaison pour trier selon l'ordre croissant
		function triageDureeCroissant($a, $b){
			
			$dureeA = explode(":",$a->getDuree());
			$dureeB = explode(":",$b->getDuree());
			$tmpsSecondesA = 0;
			$tmpsSecondesB = 0;
			
			$tmpsSecondesA += $dureeA[0]*60;
			$tmpsSecondesA += $dureeA[1];
			$tmpsSecondesB += $dureeB[0]*60;
			$tmpsSecondesB += $dureeB[1];
			
			if($tmpsSecondesA == $tmpsSecondesB)
				return 0;
			return ($tmpsSecondesA > $tmpsSecondesB) ? 1 : -1;
		}
		
		//fonction de comparaison pour trier selon l'ordre décroissant
		function triageDureeDecroissant($a, $b){
				
			$dureeA = explode(":",$a->getDuree());
			$dureeB = explode(":",$b->getDuree());
			$tmpsSecondesA = 0;
			$tmpsSecondesB = 0;
				
			$tmpsSecondesA += $dureeA[0]*60;
			$tmpsSecondesA += $dureeA[1];
			$tmpsSecondesB += $dureeB[0]*60;
			$tmpsSecondesB += $dureeB[1];
				
			if($tmpsSecondesA == $tmpsSecondesB)
				return 0;
			return ($tmpsSecondesA > $tmpsSecondesB) ? -1 : 1;		
		}
		
		//choisir la bonne fonction de comparaison selon l'ordre choisi et trier la liste par valeur
		$triage = ($ordre == 'croissant') ? 'triageDureeCroissant' : 'triageDureeDecroissant';
		usort($liste, $triage);
		return $liste;
	}
	
	/**
	 * Fonction qui permet de trier une liste de pièces selon leur titre
	 *
	 * @param $liste la liste à trier
	 * @param $ordre l'ordre selon lequel trier (croissant ou décroissant)
	 * @return $liste la liste triée
	 */
	public function trierListeTitre($liste, $ordre){
		
		//fonction de comparaison pour trier selon l'ordre croissant
		function triageTitreCroissant($a, $b){
			return strcasecmp($a->getTitre(), $b->getTitre());
		}
		
		//fonction de comparaison pour trier selon l'ordre décroissant
		function triageTitreDecroissant($a, $b){
			if(strcasecmp($a->getTitre(), $b->getTitre()) > 0)
				return -1;
			if(strcasecmp($a->getTitre(), $b->getTitre()) < 0)
				return 1;
			else
				return 0;
		}
		
		//choisir la bonne fonction de comparaison selon l'ordre choisi et trier la liste par valeur
		$triage = ($ordre == 'croissant') ? 'triageTitreCroissant' : 'triageTitreDecroissant';
		usort($liste, $triage);
		return $liste;
	}
	
	/**
	 * Fonction qui permet de valider le champ titre de l'ajout d'album
	 * 
	 * @param $titre le titre de l'album
	 */
	public function validationTitreAlbum($titre){
		return preg_match("/^[a-zA-Z ]{1,40}$/u", trim($titre));
	}
	
	/**
	 * Fonction qui permet de valider le champ artiste de l'ajout d'album
	 * 
	 * @param $artiste l'artiste de l'album
	 */
	public function validationArtisteAlbum($artiste){
		return preg_match("/^[a-zA-Z ]{1,40}$/u", trim($artiste));
	}
	
	/**
	 * Fonction qui permet de valider le champ url de l'ajout d'album
	 * 
	 * @param $url l'url de l'album
	 */
	public function validationUrlArtiste($url){
		return preg_match("/^([\da-z\.-]+)\.([a-z\.]{1,6})$/u", $url);
	}
	
	/**
	 * Fonction qui permet de valider les champs de titre et de duree des pièces de l'ajout d'album
	 * 
	 * @param $titre le titre d'une des pièces de l'album
	 * @param $duree le titre d'une des pièces de l'album
	 */
	public function validationTitresPieces($titre, $duree){
		$erreur = 'ajoutListeBox';
		if(preg_match("/^[a-zA-Z ]{1,40}$/u", trim($titre)) == false && $duree != '')
			$erreur = "erreurTitrePieces";
		return $erreur;
	}
	
	public function validationDureesPieces($titre, $duree){
		$erreur = 'ajoutListeBox';
		if($titre !='' && $duree == '' || preg_match("/^([0-9]|2[0-3]):[0-5][0-9]?/", $duree) == false && $duree != '')
			$erreur = "erreurDureePieces";
		return $erreur;
	}
	
	/**
	 * Fonction qui permet de valider le champ image Pochette de l'ajout d'album
	 * 
	 * @param $imagePochette l'image de la pochette de l'album
	 */
	public function validationImagePochette($imagePochette){
		return ($imagePochette['name'] != "");
	}
}

?>