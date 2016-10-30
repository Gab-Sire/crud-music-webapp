<?php
	require 'libelles_fr.php';
	$titrePage = $titreAjout;
	$minInputPieces = 5;
	if(isset($_POST["ajoutPieces"])) {
		if (isset($_POST['count'])){
			$count = $_POST['count'] + 2;
			$minInputPieces += $count;
		}
		else $count = 0;
	}
	
	if(isset($_POST["submit"])){	
		if (isset($_POST['count'])){
			$count = $_POST['count'];
			$minInputPieces += $count;
		}
	}
	
?>

<form action="index.php?action=ajouter" method="post" enctype="multipart/form-data">
	<div>
		<h2><?=$ajoutTitreInformationsBase?></h2>
		<label class="ajoutInfosLabel"><?=$ajoutInformationsBaseTitre?></label><input type="text" class="<?php if(isset($titreInputClasse)) echo $titreInputClasse; else echo "ajoutInfosBox";?>" name="titreAlbum" value="<?php if(isset($_POST['titreAlbum'])) echo $_POST['titreAlbum'];?>"/><br />
		<label class="ajoutInfosLabel"><?=$ajoutInformationsBaseArtiste?></label><input type="text" class="<?php if(isset($artisteInputClasse)) echo $artisteInputClasse; else echo "ajoutInfosBox";?>"  name="artiste" value="<?php if(isset($_POST['artiste'])) echo $_POST['artiste'];?>"/><br />
		<label class="ajoutInfosLabel"><?=$ajoutInformationsBaseURL?></label><input type="text" class="<?php if(isset($urlArtisteClasse)) echo $urlArtisteClasse; else echo "ajoutInfosBox"?>" name="urlArtiste" value="<?php if(isset($_POST['urlArtiste'])) echo $_POST['urlArtiste'];?>"/>
	</div>
	<div>
		<h2><?=$ajoutTitreListePieces?></h2>
		<table id="tablePieces">
			<thead>
				<tr>
					<th class="titrePiece"><?=$ajoutListePiecesTitre?></th>
					<th class="dureePiece"><?=$ajoutListeDuree?></th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0; $i < $minInputPieces; $i++){?>
				<tr>
					<td class="titrePiece"><input type='text' class="<?php if(isset($erreurTitrePiece[$i]))echo $erreurTitrePiece[$i]; else echo 'ajoutListeBox';?>" name="titresPieces[]" value="<?php if(isset($_POST['titresPieces'][$i])) echo $_POST['titresPieces'][$i];//if(isset($_POST['titrePieces'])) echo $_POST['titrePieces'][$i]?>"/></td>
					<td class="dureePiece"><input type='text' class="<?php if(isset($erreurDureePiece[$i])) echo $erreurDureePiece[$i]; else echo 'ajoutListeBox';?>" name='dureesPieces[]' value="<?php if(isset($_POST['dureesPieces'][$i])) echo $_POST['dureesPieces'][$i];//if(isset($_POST['titrePieces'])) echo $_POST['titrePieces'][$i]?>"/></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<button type="submit" name="ajoutPieces" formaction="<?php echo $_SERVER['PHP_SELF']."?action=ajouter";?>" value="<?=$ajoutListeBouton?>"><?=$ajoutListeBouton?></button>
	<div class="sectionBoutons">
		<h2><?=$ajoutTitreImagePochette?></h2>
			<div>
				<input type="file" name="imagePochette" class="<?php if(isset($imagePochetteClasse)) echo $imagePochetteClasse; ?>" value="<?php if(isset( $_FILES['imagePochette'])) echo $_FILES['imagePochette']['name'];?>"/> 
			</div>
	</div>
	<div class="sectionBoutons">
			<input type="submit" name="submit" value="<?=$ajoutBoutonConfirmation?>" />
			<a href="index.php"><input type="button" value="<?=$ajoutBoutonAnnulation?>" /></a>
	</div>
	<input type="hidden" name="count" value="<?php if (isset($_POST['count'])) echo $count;?>" />
</form>