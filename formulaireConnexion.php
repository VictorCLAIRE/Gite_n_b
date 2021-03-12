<?php
ob_start();
require "classes/Connexion.php";
$Connexion = new Connexion ();

$Connexion->FormulaireVerificationAdmin();


$content=ob_get_clean();
//Rappel du template sur chaque page
require "views/template.php";
?>