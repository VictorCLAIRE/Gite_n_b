<?php
ob_start();
$title="Accueil";

require "classes/Model_Gite.php";
$gite= new ModelGite();


?>

    <!-- Main-->
    <div class="">
            <!-- Barre de recherche-->
            <div class="formulaire">
                <?php
                $gite->SearchGite();
                ?>
            </div>
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Nos logements :</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
                    <?php
                    $gite->ShowLogement();
                    ?>
                </div>

            </div>
    </div>
       
        <!-- Contact Section-->
        <section class="page-section" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contact</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="container text-center">
                      <div class="more-info text-center">
                        <ul class="list-ico">
                          <li>France Grenoble 38000 </li>
                          <li>06.**.**.**.</li>
                          <li>*gite'n'b*@****.com</li>
                        </ul>
                      </div>
                    </div>
            </div>
        </section>

    <?php
    //$content de template.php definis ce qui ce trouve dans le body
    //Retourne le contenu du tampon de sortie et termine la session de temporisation. 
    //Si la temporisation n'est pas activée, alors false sera retourné.
    $content = ob_get_clean();
    //Rappel du template sur chaque page
    require "views/template.php";
    ?>

        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>