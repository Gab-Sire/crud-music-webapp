<?php
	require 'libelles_fr.php';
?>

<h1><?=$titreListe?></h1>
<div id="listeRecherche">
	<form action="index.php?action=rechercher" method="post">
		<input type="text" name="recherche" id="barreRecherche"/><br />
		<input type="submit" value=<?=$listeBoutonRecherche; ?> />
	</form>
</div>
<div>
	<div>
		<form action="index.php?action=ajouter" method="post" >
			<input type="submit" value=<?=$listeBoutonAjouter;?> />
		</form>
		<input type="button" id="listeBoutonSupprimer" value=<?=$listeBoutonSupprimer; ?> />
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
			echo "<input  type='radio' />";
			echo "</div>";
			$id++;
		}
	?>
	</div>
</div>