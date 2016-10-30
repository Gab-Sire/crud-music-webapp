<?php

//crée et le contrôleur frontal qui aiguille les différentes actions
require_once("controleur/Controleur.php");
$controleur = new Controleur();
$controleur->dispatch();

?>