<?php
	require 'libelles_fr.php';
	$titrePage = $album->getTitre();
?>


<div id="detailAlbum">
	<img src="images/<?=$album->getImagePochette();?>" alt="images/<?=$album->getImagePochette();?>" />
	<div id="descriptionAlbum">
		<p><?=$detailArtiste?>: <?=$album->getNomArtiste();?></p>
		<p><?=$detailNbPieces?>: <?=$album->getNbPieces();?></p>
		<p><?=$detailTempsTotal?>: <?=$album->getTempsTotal();?></p>
		<p><?=$detailLien?>: <a href="http://<?=$album->getLienArtiste();?>" target='_blank'><?=$album->getLienArtiste();?></a></p>
	</div>
</div>
<table id='tableDetailAlbumPieces'>
	<thead>
		<tr>
			<th><a href="index.php?action=trier&triage=numero&ordre=croissant&titre=<?=$album->getTitre()?>"><img src="images/1354785691_sort_ascending.png" alt="" /></a><?=$detailNumeroPiece?>
			<a href="index.php?action=trier&triage=numero&ordre=decroissant&titre=<?=$album->getTitre()?>"><img src="images/1354785628_sort_descending.png" alt="" /></a></th>
			<th><a href="index.php?action=trier&triage=duree&ordre=croissant&titre=<?=$album->getTitre()?>"><img src="images/1354785691_sort_ascending.png" alt="" /></a><?=$detailDureePiece?>
			<a href="index.php?action=trier&triage=duree&ordre=decroissant&titre=<?=$album->getTitre()?>"><img src="images/1354785628_sort_descending.png" alt="" /></a></th>
			<th><a href="index.php?action=trier&triage=titre&ordre=croissant&titre=<?=$album->getTitre()?>"><img src="images/1354785691_sort_ascending.png" alt="" /></a><?=$detailTitrePiece?>
			<a href="index.php?action=trier&triage=titre&ordre=decroissant&titre=<?=$album->getTitre()?>"><img src="images/1354785628_sort_descending.png" alt="" /></a></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$listePieces = $album->getListePieces();
			
			//si l'utilisateur n'a pas trié la liste de pièces (si l'affichage est naturelle) considère la liste non triée comme la liste
			if(!isset($listePiecesTriee))
				$listePiecesTriee = $listePieces;
			
			//construit le tableau avec les éléments des pièces de la liste de pièces
			foreach($listePiecesTriee as $piece){
				echo "<tr>";
				echo "<td>" . $piece->getNumero() . "</td>";
				echo "<td>" . $piece->getDuree() . "</td>";
				echo "<td>" . $piece->getTitre() . "</td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<div class='retour'>
	<a href="index.php"><input type="button" class="boutonRetour" value="<?=$detailRetour?>" /></a>	
</div>