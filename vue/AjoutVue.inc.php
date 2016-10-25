<?php
	require 'libelles_fr.php';
	define("MAXINPUTPIECES", 5);
?>

<h1><?=$titreAjout?></h1>

<form>
	<div>
		<h2><?=$ajoutTitreInformationsBase?></h2>
		<label class="ajoutInfosLabel"><?=$ajoutInformationsBaseTitre?></label><input type="text" class="ajoutInfosBox" /><br />
		<label class="ajoutInfosLabel"><?=$ajoutInformationsBaseArtiste?></label><input type="text" class="ajoutInfosBox" /><br />
		<label class="ajoutInfosLabel"><?=$ajoutInformationsBaseURL?></label><input type="text" class="ajoutInfosBox" />
	</div>
	<div>
		<h2><?=$ajoutTitreListePieces?></h2>
			<!-- Cette partie est à enlever, la bonne est avec le table
			<div>
				<div id="ajoutListeTitre">
					<h3><?=$ajoutListePiecesTitre?></h3>
				
					<?php 
						for($i = 0; $i < 5; $i++){
							echo "<input type='text' class='ajoutListeBox' name='ajoutListeBox$i'/>";
						}
					?>
				</div>
				<div id="ajoutListeDuree">
					<h3><?=$ajoutListeDuree?></h3>
					<?php 
						for($i = 0; $i < 5; $i++){
							echo "<input type='text' class='ajoutListeBox' name='ajoutListeBox$i'/>";
						}
					?>
				</div>
			</div>-->
		<table id="tablePieces">
			<thead>
				<tr>
					<th class="titrePiece"><?=$ajoutListePiecesTitre?></th>
					<th class="dureePiece"><?=$ajoutListeDuree?></th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=1; $i <= MAXINPUTPIECES; $i++){?>
				<tr>
					<td class="titrePiece"><input type='text' class='ajoutListeBox' name='ajoutListeBox$i'/></td>
					<td class="dureePiece"><input type='text' class='ajoutListeBox' name='ajoutListeBox$i'/></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
		<input type="button" value="<?=$ajoutListeBouton?>"/>
	</div>
	<div class="sectionBoutons">
		<h2><?=$ajoutTitreImagePochette?></h2>
			<div>
				<input type="file" value="<?=$ajoutBoutonChoisir?>" />
			</div>
	</div>
	<div class="sectionBoutons">
			<input type="submit" value="<?=$ajoutBoutonConfirmation?>" />
			<a href="index.php"><input type="button" value="<?=$ajoutBoutonAnnulation?>" /></a>
	</div>
</form>
