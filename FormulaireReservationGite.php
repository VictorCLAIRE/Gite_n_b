<?php
session_start();
ob_start();
$title="Formulaire de réservation";
require "classes/Model_Gite.php";
$gite = new ModelGite();
require "Reservation.php";
$emailValidation = new Reservation();

$db = $gite->getPDO();
$ID = $_GET['ID'];
?>
    <h1 class="text-center">
        RESERVATION
    </h1>

<?php
$gite->ShowLogementByIdReservation();
?>

    <a class="btn btn-secondary m-1 text-center btn-lg btn-block" href="index.php">Retour accueil</a>

<?php
    if (isset($_POST['validReservation'])) {
    $emailValidation->reserverGite();
    echo "<h3 class='alert-success p-3 text-danger'>Un email vient de vous être envoyé, merci de verifié votre boite mail pour confirmer votre resevation</h3>";
    } else {
    echo "";
    }
?>

<?php
$content=ob_get_clean();
//Rappel du template sur chaque page
require "views/template.php";
?>