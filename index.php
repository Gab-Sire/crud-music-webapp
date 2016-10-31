<!-- ******************************************************************
	Nom du fichier: 	ResultatRechercheVue.inc.php

	Auteur:				Vincent Perrault et Gabriel Cyr
	Date de creation: 	30 octobre 2016
	Cours-Groupe: 		420-323-AL groupe: 1 et 2
	
	But du document:
		Page qui représente la vue d'inclusion de recherche dans les albums de l'application
********************************************************************  -->
<?php

//crée et le contrôleur frontal qui aiguille les différentes actions
require_once("controleur/Controleur.php");
$controleur = new Controleur();
$controleur->dispatch();

?>