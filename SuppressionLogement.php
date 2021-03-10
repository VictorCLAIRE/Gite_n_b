<?php
    ob_start();
    require "classes/Model_Gite.php";
    $gite = new ModelGite();

    $db = $gite->getPDO();
    $ID = $_GET['ID_suppr'];

    $gite->ShowLogementByIdSuppr();





$content=ob_get_clean();
//Rappel du template sur chaque page
require "views/template.php";
?>