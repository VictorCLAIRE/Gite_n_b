<?php
session_start();
ob_start();
require "classes/Connexion.php";
$title = "Formulaire de connexion";
$Connexion = new Connexion ();
?>

    <h2 class="text-center"> Formulaires de connexion</h2>
    <h6 class="text-center"><em>Le rôle admin permet la suppression, la modification et l'ajout de nouveaux gites.</em></h6>
    <h6 class="text-center"><em>Le rôle User permet de créer une réservation pour un ou plusieurs gites avec envoie d'email de confirmation. Il peut également commenter son séjour dans le gite concerné</em></h6>
    <h6 class="text-center"><em>Les fonctions donnant accès à une modification de la base de donnée sont bloqués pour la version de démo.</em></h6>
    <div class="row">
        <div class="col-6">
            <?php
            $Connexion->FormulaireVerificationAdmin();
            ?>
            <div class="m-2 text-center">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Login</th>
                            <th scope="col">Mot de passe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-info">
                            <td>admin@admin.fr</td>
                            <td>admin</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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