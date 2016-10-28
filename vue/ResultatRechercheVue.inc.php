<?php
	require 'libelles_fr.php';
	$titrePage = $titreRecherche;
	
	// si le tableau des résultats trouvés ne contient aucun résultat affiche un message d'erreur
	
	if(sizeof($tableauTrouves) == 2) {
		echo "<p><span id='erreurRecherche'>" . $erreurRecherche . $expression . "</span><p>";
	}
	else {
		
		//construit un tableau des résultats trouvés
		
		echo "<table>";
		echo "<tr><th><?=$rechercheArtiste?></th><th><?=$rechercheAlbum?></th><th><?=$recherchePiece?></th></tr>";
	
		
		$elementEvidence = "<span class='texteTrouve'>" . strtoupper($tableauTrouves[0]) . "</span>";
		$albumInitial = "";
	
		
		foreach($tableauTrouves as $elementTrouve){
			
			foreach($albums as $album){
				
				//cherche le titre et l'artiste de l'album
				$titre = $album->getTitre();
				$artiste = $album->getNomArtiste();
						
				//remplace l'expression dans le titre de l'album et/ou nom de l'artiste par l'expression stylée en évidence correspondante
				$titre = preg_replace($tableauTrouves[1], $elementEvidence, $titre);
				$artiste = preg_replace($tableauTrouves[1], $elementEvidence, $artiste);
				
				//écrit une entrée de tableau si le titre ou l'artiste de l'album correspond à l'expression recherchée
				if($elementTrouve == $album->getTitre() || $elementTrouve == $album->getNomArtiste()){	
					
					if($albumInitial != $album)
						echo "<tr><td>" . $artiste . "</td><td>" . $titre . "</td><td>-</td></tr>";
					$albumInitial = $album;
				}
				
				$listePieces = $album->getListePieces();
				foreach($listePieces as $piece){
					
					//écrit une entrée de tableau si le titre de la pièce correspond à l'expression recherchée
					if($elementTrouve == $piece->getTitre()){
						
						//cherche le titre de la pièce
						$pieceTitre = $piece->getTitre();
						
						//remplace l'expression dans le titre de la pièce par l'expression stylée en évidence correspondante
						$pieceTitre = preg_replace($tableauTrouves[1], $elementEvidence, $pieceTitre);
						
						echo "<tr><td>" . $artiste . "</td><td>" . $titre . "</td><td>" . $pieceTitre . "</td></tr>";
					}
				}
			}
		}
		echo "</table>";
	}
?>
</table>

<input type="button" value="<?=$rechercheBoutonRetour?>" />

