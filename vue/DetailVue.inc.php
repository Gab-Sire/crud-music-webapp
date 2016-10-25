<?php
	require 'libelles_fr.php';
?>

<h1><?=$album->getTitre();?></h1>

<div>
	<img src="images/<?=$album->getImagePochette();?>" alt="images/<?=$album->getImagePochette();?>" />
	<div>
		<p><?=$detailArtiste?>: <?=$album->getNomArtiste();?></p>
		<p><?=$detailNbPieces?>: <?=$album->getNbPieces();?></p>
		<p><?=$detailTempsTotal?>: <?=$album->getTempsTotal();?></p>
		<p><?=$detailLien?>: <a href="<?=$album->getLienArtiste();?>"><?=$album->getLienArtiste();?></a></p>
	</div>
</div>
<div>
	<form action="index.php">
		<table>
			<tr>
				<th><img src="images/1354785691_sort_ascending.png" alt="" /><?=$detailNumeroPiece?><img src="images/1354785628_sort_descending.png" alt="" /></th>
				<th><img src="images/1354785691_sort_ascending.png" alt="" /><?=$detailDureePiece?><img src="images/1354785628_sort_descending.png" alt="" /></th>
				<th><img src="images/1354785691_sort_ascending.png" alt="" /><?=$detailTitrePiece?><img src="images/1354785628_sort_descending.png" alt="" /></th>
			</tr>
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
		</table>
		<input type="submit" value="<?=$detailRetour?>" />
	</form>

</div>