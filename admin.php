<?php
session_start();
ob_start();
$title="Administration";
require "classes/Model_Gite.php";
$gite= new ModelGite();


    if (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] == true){
    ?>
    <div class="container-fluid">
        <div class="container-fluid text-center">
        <h1>Gestion des logements :</h1>
        <a class="btn btn-primary" href="AjoutLogement.php">Ajouter d'un logement</a>

            <div class="container-fluid row mt-3">
                <?php
                $gite->ShowLogementAdmin();
                ?>
            </div>
        </div>
    </div>
    <?php
    }else{
     header("location:http://localhost/Projet_5_Gite_new/FormulaireConnexion.php");
    }
?>



<?php
    $content = ob_get_clean();
    //Rappel du template sur chaque page
    require "views/template.php";
?>
