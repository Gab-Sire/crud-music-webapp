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
					supprimeAlbum($entite);
					break;
				case "ajouterPieces":
					ob_start();
					include './vue/AjoutVue.inc.php';
					$contenuSpecifique = ob_get_clean();
					require_once('vue/gabarit.php');
					break;
				case "ajouter":
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
						//allo
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
