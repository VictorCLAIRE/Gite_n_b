<?php
session_start();
//session_start();
ob_start();
$title="Détails du logement";

require "classes/Model_Gite.php";
$gite = new ModelGite();

$db = $gite->getPDO();
$ID = $_GET['ID'];


$gite->ShowLogementByIdDetails();
?>

<?php
$content=ob_get_clean();
//Rappel du template sur chaque page
require"views/template.php";

?>