<?php

require "classes/database.php";

class Connexion extends database{

    public function FormulaireVerificationAdmin(){
        $db = $this->getPDO();
        if(isset($_SESSION['connecter']) && $_SESSION['connecter'] == true){
            echo "Vous êtes déja connecté";
        }else{
        ?>
                <h4 class="text-center">Admin</h4>
                <form class="" method="post" >
                    <div class="form-group">
                        <label for="email_admin_loger">Email</label>
                        <input class="form-control" type="email" id="email_admin_loger" name="email_admin_loger">
                    </div>
                    <div class="form-group">
                        <label for="mdp">Mot de passe</label>
                        <input class="form-control" type="text" id="mdp_admin_loger" name="mdp_admin_loger">
                    </div>
                    <button class="btn btn-success" type="submit" value="Connexion" name="Connexion" >Connexion</button>
                </form>

        <?php

            if (isset($_POST['Connexion'])) {
                $this->VerificationAdmin();
            }else{
                echo "";
            }
        }
    }
    public function FormulaireVerificationUser(){
        $db = $this->getPDO();
        if(isset($_SESSION['connecter']) && $_SESSION['connecter'] == true){
            echo "Vous êtes déja connecté";
        }else{
            ?>
            <h4 class="text-center">User</h4>
            <form class="" method="post" >
                <div class="form-group">
                    <label for="email_admin_loger">Email</label>
                    <input class="form-control" type="email" id="email_user_loger" name="email_user_loger">
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input class="form-control" type="text" id="mdp_user_loger" name="mdp_user_loger">
                </div>
                <button class="btn btn-success" type="submit" value="Connexion" name="UserConnexion" >Connexion</button>
            </form>
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
                        <td>MonsieurRelou@relouf.fr</td>
                        <td>RelouForEver</td>
                    </tr>
                    <tr class="table-info">
                        <td>MonsieurGentil@gentil.fr</td>
                        <td>GentilForEver</td>
                    </tr>
                    <tr class="table-info">
                        <td>MadameMitigée@mitigée.fr</td>
                        <td>MitigéeForEver</td>
                    </tr>
                </tbody>
            </table>
        </div>
            </div>
            
            </div>
            <?php

            if (isset($_POST['UserConnexion'])) {
                $this->VerificationUser();
            }else{
                echo "";
            }
        }
    }

    public function VerificationAdmin(){

        $db = $this->getPDO();

        if (!empty($_POST['email_admin_loger']) && !empty($_POST['mdp_admin_loger'])) {

            $sql = "SELECT * FROM admin_logement WHERE email_admin_logement = ? AND mdp_admin_logement=?";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(1, $_POST['email_admin_loger']);
            $stmt->bindParam(2, $_POST['mdp_admin_loger']);

            $stmt->execute();

            if ($stmt->rowCount() >= 1) {

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (($_POST['email_admin_loger'] == $row['email_admin_logement']) && ($_POST['mdp_admin_loger'] == $row['mdp_admin_logement'])) {

                    session_start();
                    $_SESSION['connecter_admin'] = true;
                    $_SESSION['email_admin_logement'] = $_POST['email_admin_loger'];

                    header("location:https://victorclaire.com/Projets/AirNBN/admin.php");
                } else {
                    echo "L'email ou le mdp n'est pas bon";
                }
            }
        } elseif (empty($_POST['email_admin_loger']) || empty($_POST['mdp_admin_loger'])) {

                echo "<div class='alert alert-danger m-2 text-center' role='alert'>Merci de remplir tous les champs</div>";

        } else {
        }
    }

    public function VerificationUser(){

        $db = $this->getPDO();

        if (!empty($_POST['email_user_loger']) && !empty($_POST['mdp_user_loger'])) {

            $sql = "SELECT * FROM user_gite WHERE email_user = ? AND mdp_user=?";

            $req = $db->prepare($sql);

            $req->bindParam(1, $_POST['email_user_loger']);
            $req->bindParam(2, $_POST['mdp_user_loger']);

            $req->execute();
            $row=$req->fetch(PDO::FETCH_ASSOC);

            if (($_POST['email_user_loger'] == $row['email_user']) && ($_POST['mdp_user_loger'] == $row['mdp_user'])) {

                session_start();
                $_SESSION['connecter_user'] = true;
                $_SESSION['email_user'] = $row['email_user'];

                header("location:https://victorclaire.com/Projets/AirNBN/index.php");

            } else {
                echo "<div class='alert alert-danger m-2 text-center' role='alert'>L'email ou le mdp n'est pas bon</div>";
            }

        } elseif (empty($_POST['email_admin_loger']) || empty($_POST['mdp_admin_loger'])) {

            echo "<div class='alert alert-danger m-2 text-center' role='alert'>Merci de remplir tous les champs</div>";

        } else {
        }
    }
}







