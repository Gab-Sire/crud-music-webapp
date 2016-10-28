<?php
	require 'libelles_fr.php';
	$titrePage = $titreListe;
?>

<div id="listeRecherche">
<<<<<<< HEAD
	<form action="index.php?action=rechercher" method="post">
		<input type="text" name="recherche" id="barreRecherche"/><br />
		<input type="submit" value=<?=$listeBoutonRecherche;?> />
=======
	<form action="index.php?entite=album&action=rechercher" method="post">
		<input type="text" name="recherche" id="barreRecherche"/><br />
		<input type="submit" value=<?=$listeBoutonRecherche; ?> />
>>>>>>> 4794cc60aef1aca67451dc823e0c6fc1f9dee010
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
			<input type="submit" id="listeBoutonSupprimer"  name="listeBoutonSupprimer" value="<?=$listeBoutonSupprimer;?>" onclick="return confirm('Voulez-vous vraiment supprimer les albums sélectionnés ?')"/>
		<?php
		
		
		$albumModele = new AlbumModele();
		// le tableau des albums
		$collectionAlbums = $albumModele->albums;
		//l'emplacement de l'album dans le tableau
		$id= 0;
		
			foreach ($collectionAlbums as $album) { 
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