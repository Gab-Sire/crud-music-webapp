<?php	
require_once('modele/AlbumModele.php');

	class Controleur {
	
		private $modele;
		
		public function __construct() {
		}
		
		/**
		 * Fonction qui permet d'aiguiller les différentes actions désirées par l'utilisateur
		 */
		public function dispatch(){
			$action = (isset($_GET['action']) ? $_GET['action'] : "");							//action pour aiguiller
			$id = (isset($_GET['id']) ? $_GET['id'] : "");										//identifiant pour rechercher un album par son id
			$expression = (isset($_POST['recherche']) ? $_POST['recherche'] : "");				//expression recherchée 
			$triage = (isset($_GET['triage']) ? $_GET['triage'] : "");							//triage voulu pour trier les pièces dans détail
			$ordre = (isset($_GET['ordre']) ? $_GET['ordre'] : "");								//ordre voulu pour trier les pièces dans détail
			$titreAlbum = (isset($_GET['titre']) ? $_GET['titre'] : "");						//titre pour recherche un album par son titre
			$confirmationSupprimer = (isset($_POST['supprimer']) ? $_POST['supprimer'] : false);//confirmation pour supprimer l'album ou non
			
			switch($action){
				case "detail":
					$this->modele = new AlbumModele();
					
					//cherche l'album selon son identifiant
					$album = $this->modele->getById($id);
					ob_start();
					include './vue/DetailVue.inc.php';
					$contenuSpecifique = ob_get_clean();
					require_once('vue/gabarit.php');
					break;
				case "trier":
					$this->modele = new AlbumModele();
					
					//cherche l'album selon son titre et prend sa liste de pièces
					$album = $this->modele->getByTitre($titreAlbum);
					$listePieces = $album->getListePieces();
					
					//aiguille la fonction dans AlbumModèle selon le triage voulu (par numéro, durée ou titre)
					switch($triage){
						case "numero":
							$listePiecesTriee = $this->modele->trierListeNumero($listePieces, $ordre);
							break;
						case "duree":
							$listePiecesTriee = $this->modele->trierListeDuree($listePieces, $ordre);
							break;
						case "titre":
							$listePiecesTriee = $this->modele->trierListeTitre($listePieces, $ordre);
							break;
					}
					ob_start();
					include './vue/DetailVue.inc.php';
					$contenuSpecifique = ob_get_clean();
					require_once('vue/gabarit.php');
					break;
				case "supprimer":
					//si la confirmation a eu lieu
					if($confirmationSupprimer != ""){
						
						/*	crée un modele et un tableau des éléments transmis, si la valeur de la boite à cocher est checked (n'est pas vide)
						 	prend le id contenu et supprime l'album correspondant */
						$this->modele = new AlbumModele();
						$elementsASupprimer = array();
						foreach($_POST['checkbox'] as $checkbox){
							$elementsASupprimer[] = $checkbox;
						}
						if(isset($elementsASupprimer)){
							foreach($elementsASupprimer as $element){
							 	if(isset($element) && $element != ""){
							 		$id = $element;
							 		$album = $this->modele->getById($id);
							 		$this->modele->supprimeAlbum($album, $id);
								}
							}
						}
					}
					unset($this->modele);
					$this->modele = new AlbumModele();
					ob_start();
					include './vue/ListeVue.inc.php';
					$contenuSpecifique = ob_get_clean();
					require_once('vue/gabarit.php');
					break;
				case "ajouter":
					//Validation des champs de saisie d'un album pour la redirection
					if(isset($_POST['submit'])){
						$this->modele = new AlbumModele();
						
						// Validations des saisies du titre, de l'artiste, de l'url, l'image Pochette et les pieces
						$validationTitre = $this->modele->validationTitreAlbum($_POST['titreAlbum']);
						$validationArtiste = $this->modele->validationArtisteAlbum($_POST['artiste']);
						$validationUrl = $this->modele->validationUrlArtiste($_POST['urlArtiste']);
						$validationImagePochette = $this->modele->validationImagePochette($_FILES['imagePochette']);
						
						// Verification + Changement de style si les champs sont invalides
						$titreInputClasse = ($validationTitre == false) ? "erreur" : "ajoutInfosBox";
						$artisteInputClasse = ($validationArtiste == false) ? "erreur" : "ajoutInfosBox";
						$urlArtisteClasse = ($validationUrl == false) ? "erreur" : "ajoutInfosBox";
						$imagePochetteClasse = ($validationImagePochette == false) ? "erreurImagePochette" : "";
						
						if($validationTitre = $validationArtiste = $validationUrl = $validationImagePochette == true){
							/*ob_start();
							include './vue/ListeVue.inc.php';
							$contenuSpecifique = ob_get_clean();
							require_once('vue/gabarit.php');
							break;*/
							//header('Location: index.php');
						}
					}
					ob_start();
					include './vue/AjoutVue.inc.php';
					$contenuSpecifique = ob_get_clean();
					require_once('vue/gabarit.php');
					break;
				case "rechercher":
					//si la requête de recherche est vide, ré-affiche l'index
					if(trim($expression) != ""){
						$this->modele = new AlbumModele();
						$albums = $this->modele->getAll();
						$tableauTrouves = $this->modele->recherche($expression);
						ob_start();
						include './vue/ResultatRechercheVue.inc.php';
						$contenuSpecifique = ob_get_clean();
						require_once('vue/gabarit.php');
						break;
					}
				default:
					$this->modele = new AlbumModele();
					ob_start();
					include './vue/ListeVue.inc.php';
					$contenuSpecifique = ob_get_clean();
					require_once('vue/gabarit.php');
					break;
			}
		}
	}
