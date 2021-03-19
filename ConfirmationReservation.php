<?php
session_start();

ob_start();
$title="Confirmation de réservation";

require "classes/Model_Gite.php";
$gite = new ModelGite();

$db = $gite->getPDO();
$ID = $_GET['id'];

?>
<h1 class="text-center"> Votre réservation vient d'être confirmée</h1>
<?php

$gite->ShowLogementByIdDetailsConfirmResa();
?>

<?php
$content=ob_get_clean();
//Rappel du template sur chaque page
require"views/template.php";

?>