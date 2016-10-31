<!-- ******************************************************************
	Nom du fichier: 	ListeVue.inc.php

	Auteur:				Vincent Perrault et Gabriel Cyr
	Date de creation: 	30 octobre 2016
	Cours-Groupe: 		420-323-AL groupe: 1 et 2
	
	But du document:
		Page qui représente la vue principale d'inclusion pour l'affichage de tous les albums de l'application
********************************************************************  -->
<?php
	require 'libelles_fr.php';
	$titrePage = $titreListe;
?>

<div id="listeRecherche">
	<form action="index.php?action=rechercher" method="post">
		<input type="text" name="recherche" id="barreRecherche"/><br />
		<input type="submit" value=<?=$listeBoutonRecherche; ?> />
	</form>
</div>
<div>
	<div>
		<form action="index.php?action=ajouter" method="post" >
			<input type="submit" value="<?=$listeBoutonAjouter;?>" />
		</form>
		
		
	</div>
	<div id="listeAlbums">
		<form action="index.php?action=supprimer" method="post" >
			<input type="submit" id="listeBoutonSupprimer"  name="supprimer" value="<?=$listeBoutonSupprimer;?>" onclick="return confirm('Voulez-vous vraiment supprimer les albums sélectionnés ?')"/>
		<?php
		
		//l'emplacement de l'album dans le tableau
		$id= 0;

			foreach ($albums as $album) { 
				echo "<div class='listeIcone'>";
				echo "<a href='index.php?action=detail&id=" . $id . "'>";
				echo "<img src='images/" . $album->getImagePochette() . "' alt='images/'" . $album->getImagePochette() . "'>";
				echo "</a>";
				echo "<label class='listeNomArtiste'>" . $album->getNomArtiste() . "</label>";
				echo "<input  type='checkbox' name='checkbox[]' value=$id />";
				echo "</div>";
				$id++;
			}
		?>
		</form>
	</div>
</div>