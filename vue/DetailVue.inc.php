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
		<p><?=$detailLien?>: <a href="<?=$album->getLienArtiste();?>" target='_blank'><?=$album->getLienArtiste();?></a></p>
	</div>
</div>
<table id='tableDetailAlbumPieces'>
	<thead>
		<tr>
			<th><img src="images/1354785691_sort_ascending.png" alt="" /><?=$detailNumeroPiece?><img src="images/1354785628_sort_descending.png" alt="" /></th>
			<th><img src="images/1354785691_sort_ascending.png" alt="" /><?=$detailDureePiece?><img src="images/1354785628_sort_descending.png" alt="" /></th>
			<th><img src="images/1354785691_sort_ascending.png" alt="" /><?=$detailTitrePiece?><img src="images/1354785628_sort_descending.png" alt="" /></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$liste = $album->getListePieces();
				
			foreach($liste as $piece){
				echo "<tr>";
				echo "<td>" . $piece->getNumero() . "</td>";
				echo "<td>" . $piece->getDuree() . "</td>";
				echo "<td>" . $piece->getTitre() . "</td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<a href="index.php"><input id="Retour" type="button" value="<?=$detailRetour?>" /></a>	