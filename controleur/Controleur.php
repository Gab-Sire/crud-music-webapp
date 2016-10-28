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
						$elementsASupprimer[] = ($_POST['checkbox']);
						if(isset($elementsASupprimer)){
							foreach($elementsASupprimer as $element){
							 	if(isset($element) && $element != ""){
							 		$id = $element;
							 		$album = $this->modele->getById($id);
							 		$this->modele->supprimeAlbum($album);
								}
							}
						}
					}
					ob_start();
					include './vue/ListeVue.inc.php';
					$contenuSpecifique = ob_get_clean();
					require_once('vue/gabarit.php');
					
					//rafraichit la page
					header("Refresh: 0; http://localhost/tp2/TP2Git/index.php");
					exit;
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
