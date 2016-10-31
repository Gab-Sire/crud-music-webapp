<!-- ******************************************************************
	Nom du fichier: 	gabarit.php

	Auteur:				Vincent Perrault et Gabriel Cyr
	Date de creation: 	30 octobre 2016
	Cours-Groupe: 		420-323-AL groupe: 1 et 2
	
	But du document:
		Page qui représente la vue commune aux pages de l'application de l'application
********************************************************************  -->
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="style/tp2Styles.css" />
		<script src="Tp02Javascript.js"></script>
	</head>
	<body>
		<header>
			<h1><?=$titrePage?></h1>
		</header>
		<?=$contenuSpecifique;?>
		<footer>
			TP2 - Automne 2016<br />
			R&eacute;alis&eacute; dans le cadre du cours 420-323 AL<br />
			C&eacute;gep Andr&eacute;-Laurendeau
		</footer>
	</body>
</html>