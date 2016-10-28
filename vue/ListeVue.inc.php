<?php
	require 'libelles_fr.php';
	$titrePage = $titreListe;
?>

<div id="listeRecherche">
	<form action="index.php?entite=album&action=rechercher" method="post">
		<input type="text" name="recherche" id="barreRecherche"/><br />
		<input type="submit" value=<?=$listeBoutonRecherche; ?> />
	</form>
</div>
<div>
	<div>
		<form action="index.php?entite=album&action=ajouter" method="post" >
			<input type="submit" value="<?=$listeBoutonAjouter;?>" />
			<input type="button" id="listeBoutonSupprimer" value="<?=$listeBoutonSupprimer; ?>" onclick="supprimeAlbums()"/>
		</form>
	</div>
	<div id="listeAlbums">
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
	</div>
</div>