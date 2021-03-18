<?php
session_start();
ob_start();
$title="Accueil";

require "classes/Model_Gite.php";
$gite= new ModelGite();
?>
    <h2 class="text-center m-2"> Tableau des booking</h2>
<?php

?>
    <div class="row m-2">
        <div class="col-3 text-center">
            <h4>id_booking</h4>
        </div>
        <div class="col-3 text-center">
            <h4>id_gite_booking</h4>
        </div>
        <div class="col-3 text-center">
            <h4>date_arrivee_booking</h4>
        </div>
        <div class="col-3 text-center">
            <h4>date_depart_booking</h4>
        </div>
    </div>

    <?php
    $gite->ShowAllBooking();
    ?>


<?php
//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "views/template.php";
?>
