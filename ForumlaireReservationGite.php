<?php
ob_start();
$title="Formulaire de réservation";
require "classes/Model_Gite.php";
$gite = new ModelGite();
require "Reservation.php";
$emailValidation = new Reservation();



$db = $gite->getPDO();
$ID = $_GET['ID'];
?>
<br>
    <br>
    <br>
    <br>
    <br>
    <h1 class="text-center">
        RESERVATION
    </h1>
<div class="row">
<?php
$gite->ShowLogementByIdReservation();
?>
</div>
<?php
    if (isset($_POST['validReservation'])) {
    $emailValidation->reserverGite();
    echo "<h3 class='alert-success p-3 text-danger'>Un email viens de vous etre envoyé, merci de verifié votre boite mail pour confirmer votre resevation</h3>";
    } else {
    echo "<p class='alert-warning p-3'>Merci de remplir le formulaire avec votre email</p>";
    }
?>



<?php
$content=ob_get_clean();
//Rappel du template sur chaque page
require "views/template.php";
?>