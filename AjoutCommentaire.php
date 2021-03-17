<?php
ob_start();
$title="Ajout d'un commentaire";
require "classes/Model_Gite.php";
$gite = new ModelGite();

$db = $gite->getPDO();
$ID = $_GET['ID'];

$gite->ShowLogementByIdDetails();
?>





<?php
$content=ob_get_clean();
//Rappel du template sur chaque page
require "views/template.php";
?>