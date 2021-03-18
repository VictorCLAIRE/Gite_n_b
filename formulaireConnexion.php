<?php
session_start();
ob_start();
require "classes/Connexion.php";
$Connexion = new Connexion ();
?>
    <h2 class="text-center"> Formulaires de connexion</h2>
<div class="row">
    <div class="col-6">
        <?php
        $Connexion->FormulaireVerificationAdmin();
        ?>
    </div>
    <div class="col-6">
        <?php
        $Connexion->FormulaireVerificationUser();
        ?>
    </div>
</div>
<?php







$content=ob_get_clean();
//Rappel du template sur chaque page
require "views/template.php";
?>