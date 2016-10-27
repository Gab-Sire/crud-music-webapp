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
	
	$titreInputClasse = $artisteInputClasse = $urlArtisteClasse = "ajoutInfosBox";
	$imagePochetteClasse = "";
	
	/*if(isset($_POST['titrePieces']))
		var_dump($_POST['titrePieces']);*/
	
	// Validation des champs du formulaire
	if(isset($_POST["submit"])) {
		if (isset($_POST['count'])){
			$count = $_POST['count'];
			$minInputPieces += $count;
		}
		
		// Validation du titre de l'album
		if(isset($_POST['titreAlbum'])){
			$titreAlbum = $_POST['titreAlbum'];
			if(strlen(trim($titreAlbum)) < 1 || strlen($titreAlbum) > 40){
				//echo "Le titre de l'album est plus de 40 caractères ou vide <br />";
				$titreInputClasse = "erreur";
			}
		}
		
		// Validation du nom de l'artiste
		if(isset($_POST['artiste'])){
			$artiste = $_POST['artiste'];
			if(strlen(trim($artiste)) < 1 || strlen($artiste) > 40){
				//echo "Le nom de l'artiste de l'album est plus de 40 caractères ou vide <br />";
				$artisteInputClasse = "erreur";
			}
		}
		
		// Validation de l'url de l'artiste
		if(isset($_POST['urlArtiste'])){
			$urlArtiste = $_POST['urlArtiste'];
			if(!preg_match("/^.*[.].*$/", $urlArtiste))
				$urlArtisteClasse = "erreur";
		}
		
		// Validation avec les pieces musicales à suivre...
		
		// Validation de l'image de la pochette
		if(isset($_POST['imagePochette'])){
			$imagePochette = $_POST['imagePochette'];
			if($imagePochette == '')
				$imagePochetteClasse = "erreur";
		}
	}
	
?>

<form action="index.php?entite=album&action=ajouter" method="post">
	<div>
		<h2><?=$ajoutTitreInformationsBase?></h2>
		<label class="ajoutInfosLabel"><?=$ajoutInformationsBaseTitre?></label><input type="text" class="<?php echo $titreInputClasse;?>" name="titreAlbum" value="<?php if(isset($_POST['titreAlbum'])) echo $_POST['titreAlbum'];?>"/><br />
		<label class="ajoutInfosLabel"><?=$ajoutInformationsBaseArtiste?></label><input type="text" class="<?php echo $artisteInputClasse;?>"  name="artiste" value="<?php if(isset($_POST['artiste'])) echo $_POST['artiste'];?>"/><br />
		<label class="ajoutInfosLabel"><?=$ajoutInformationsBaseURL?></label><input type="text" class="<?php echo $urlArtisteClasse;?>" name="urlArtiste" value="<?php if(isset($_POST['urlArtiste'])) echo $_POST['urlArtiste'];?>"/>
	</div>
	<div>
		<h2>"<?=$ajoutTitreListePieces?>"</h2>
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
					<td class="titrePiece"><input type='text' class='ajoutListeBox' name="titrePieces[]" value="<?php //if(isset($_POST['titrePieces'])) echo $_POST['titrePieces'][$i]?>"/></td>
					<td class="dureePiece"><input type='text' class='ajoutListeBox' name='piece[]' /></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<button type="submit" name="ajoutPieces" formaction="<?php echo $_SERVER['PHP_SELF']."?action=ajouterPieces";?>" value="<?=$ajoutListeBouton?>"><?=$ajoutListeBouton?></button>
	<div class="sectionBoutons">
		<h2><?=$ajoutTitreImagePochette?></h2>
			<div>
				<input type="file" name="imagePochette" value="<?=$ajoutBoutonChoisir?>" class="<?php echo $imagePochetteClasse;?>"/>
			</div>
	</div>
	<div class="sectionBoutons">
			<input type="submit" name="submit" value="<?=$ajoutBoutonConfirmation?>" />
			<a href="index.php"><input type="button" value="<?=$ajoutBoutonAnnulation?>" /></a>
	</div>
	<input type="hidden" name="count" value="<?php if (isset($_POST['count'])) echo $count;?>">
</form>

