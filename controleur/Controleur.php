<?php	
require_once('modele/AlbumModele.php');

	class Controleur {
	
		private $modele;
		
		public function __construct() {
		}
		
		public function dispatch(){
			$action = (isset($_GET['action']) ? $_GET['action'] : "");
			$id = (isset($_GET['id']) ? $_GET['id'] : "");
			$expression = (isset($_POST['recherche']) ? $_POST['recherche'] : "");
			$confirmationSupprimer = (isset($_POST['supprimer']) ? $_POST['supprimer'] : false);
			
			switch($action){
				case "detail":
					$this->modele = new AlbumModele();
					$album = $this->modele->getById($id);
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
					ob_start();
					include './vue/ListeVue.inc.php';
					$contenuSpecifique = ob_get_clean();
					require_once('vue/gabarit.php');
					
					//rafraichit la page
					header("Location : index.php?action=default");
					exit;
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
					//si la requ�te de recherche est vide, r�-affiche l'index
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
					ob_start();
					include './vue/ListeVue.inc.php';
					$contenuSpecifique = ob_get_clean();
					require_once('vue/gabarit.php');
					break;
			}
			
				
			
			
		}
		
		
		
	}
