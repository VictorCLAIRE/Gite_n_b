<?php

require "classes/database.php";

class Connexion extends database{

    public function FormulaireVerificationAdmin(){
        $db = $this->getPDO();

        if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
            echo "Vous êtes déja connecté";
        }else{
        ?>
            <form class="" method="post" >
                <h2> Formulaire de connexion</h2>
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

    public function VerificationAdmin(){
        $db = $this->getPDO();

        if(!empty($_POST['email_admin_loger']) && !empty($_POST['mdp_admin_loger'])){


            $sql = "SELECT * FROM admin_logement WHERE email_admin_logement = ? AND mdp_admin_logement=?";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(1, $_POST['email_admin_loger']);
            $stmt->bindParam(2, $_POST['mdp_admin_loger']);

            $stmt->execute();

            if($stmt->rowCount() >= 1){

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if(($_POST['email_admin_loger'] == $row['email_admin_logement']) && ($_POST['mdp_admin_loger']== $row['mdp_admin_logement'])){

                    session_start();
                    $_SESSION['connecter'] = true;
                    $_SESSION['email_admin_logement'] =$_POST['email_admin_loger'];

                    header("location:http://localhost/Projet_5_Gite_new/Admin.php");

                }else{
                    echo "L'email ou le mdp n'est pas bon";
                }

            }else{
            echo "<div class='alert alert-danger m-2 text-center' role='alert'>L'email ou le mdp n'est pas bon</div>";
                }

        }elseif(empty($_POST['email_admin_loger']) || empty($_POST['mdp_admin_loger'])){

            echo "<div class='alert alert-danger m-2 text-center' role='alert'>Merci de remplir tous les champs</div>";

        }else{

        }
    }
}
