<?php
session_start();
ob_start();
$title="Logements filtrés";

require "classes/Model_Gite.php";
$gite= new ModelGite();

?>
<div class="container-fluid text-center">

    <div class="container-fluid text-center">

            <?php
            $gite->SearchGite();
            ?>
    </div>
        <h1>Logement répondant à vos critères</h1>
        <div class="row justify-content-center">
            <?php
            $gite->ShowLogementSearch();
            ?>
        </div>

</div>

<?php
$content = ob_get_clean();
//Rappel du template sur chaque page
require "views/template.php";
?>
