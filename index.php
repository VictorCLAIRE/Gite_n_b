<?php
session_start();
ob_start();
$title="Accueil";

require "classes/Model_Gite.php";
$gite= new ModelGite();


?>

    <!-- Main-->
    <div class="">
            <!-- Barre de recherche-->
            <div class="formulaireRecherche m-2">
                <?php
                $gite->SearchGite();
                ?>
            </div>
            <div class="container-fluid">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Nos logements</h2>

                <!-- Portfolio Grid Items-->
                <div class="row divCardAccueil">
                    <?php
                    $gite->ShowLogement();
                    ?>
                </div>
            </div>
    </div>


    <?php
    //$content de template.php definis ce qui ce trouve dans le body
    //Retourne le contenu du tampon de sortie et termine la session de temporisation. 
    //Si la temporisation n'est pas activée, alors false sera retourné.
    $content = ob_get_clean();
    //Rappel du template sur chaque page
    require "views/template.php";
    ?>
