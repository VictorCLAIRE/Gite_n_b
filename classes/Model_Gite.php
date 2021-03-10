<?php
require "classes/database.php";

class ModelGite extends database{

    public function ShowLogement(){

        $db = $this->getPDO();
        $req = $db->query("SELECT * FROM `logement`ORDER BY `id_logement` DESC");

        foreach($req as $row){
            ?>
            <div class="col-4 mt-2">
                <!-- CARD -->
                <div class="card text-center">
                    <img class="d-block user-select-none" width="100%" height="250" src="<?php echo $row['photo_logement'] ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="c"><?php echo $row['intitule_logement'] ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nombre de chambre : <?php echo $row['chambre_logement'] ?></li>
                        <li class="list-group-item">Situé :<?php echo $row['emplacement_logement'] ?></li>
                        <li class="list-group-item"><?php echo $row['prix_logement'] ?>€/nuit</li>
                        <li class="list-group-item"><a class="btn btn-info" href="LogementDetails.php?ID=<?=$row["id_logement"]?>">Détails</a></li>

                    </ul>
                </div>
            </div>
            <?php
        }
    }
    public function ShowLogementAdmin(){

        $db = $this->getPDO();
        $req = $db->query("SELECT * FROM logement INNER JOIN clef_type_logement ON logement.type_logement = clef_type_logement.id_type_logement 
                                                            INNER JOIN clef_dispo_logement ON logement.dispo_logement = clef_dispo_logement.id_dispo_logement
                                                            INNER JOIN clef_option_logement ON logement.option_logement = clef_option_logement.id_option_logement
                                                            ORDER BY `id_logement` DESC");
        foreach($req as $row){
            ?>
                <!-- CARD -->
                <div class="col-4 mt-2">
                    <div class="card">
                        <img class="d-block user-select-none" width="100%" height="250" src="<?php echo $row['photo_logement'] ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class=""><?php echo $row['intitule_logement'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">iD logement: <?php echo $row['id_logement'] ?></li>
                            <li class="list-group-item"><?php echo $row['choix_type_logement'] ?></li>
                            <li class="list-group-item">Description: <?php echo $row['description_logement'] ?></li>
                            <li class="list-group-item">Etat: <?php echo $row['choix_dispo_logement'] ?></li>
                            <li class="list-group-item">Situé :<?php echo $row['emplacement_logement'] ?></li>
                            <li class="list-group-item">Nombre de chambre : <?php echo $row['chambre_logement'] ?></li>
                            <li class="list-group-item">Nombre de salle de bain: <?php echo $row['sdb_logement'] ?></li>
                            <li class="list-group-item">Option du logement :<?php echo $row['choix_option_logement'] ?></li>
                            <li class="list-group-item"><?php echo $row['prix_logement'] ?>€/nuit</li>
                            <li class="list-group-item"><a href="ModificationLogement.php?ID=<?=$row["id_logement"]?>">Modifier</a></li>
                            <li class="list-group-item"><a href="SuppressionLogement.php?ID_suppr=<?=$row["id_logement"]?>">Supprimer</a></li>
                        </ul>
                    </div>
                </div>
        <?php
        }
    }

    public function ShowLogementByIdSuppr(){

        $db = $this->getPDO();
        $req = $db->prepare("SELECT * FROM logement INNER JOIN clef_type_logement ON logement.type_logement = clef_type_logement.id_type_logement 
                                                            INNER JOIN clef_dispo_logement ON logement.dispo_logement = clef_dispo_logement.id_dispo_logement
                                                            INNER JOIN clef_option_logement ON logement.option_logement = clef_option_logement.id_option_logement
                                                            WHERE id_logement = ?  ");
        $ID=$_GET['ID_suppr'];
        $req->bindParam(1, $ID);
        $req->execute();

        $res=$req->fetch();
            ?>
            <!-- CARD -->
                <div class="mt-2 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h5 class=""><?php echo $res['intitule_logement'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><img class="" width="300" height="300" src="<?php echo $res['photo_logement'] ?>" alt="Card image cap"></li>
                            <li class="list-group-item">iD logement: <?php echo $res['id_logement'] ?></li>
                            <li class="list-group-item"><?php echo $res['choix_type_logement'] ?></li>
                            <li class="list-group-item">Description: <?php echo $res['description_logement'] ?></li>
                            <li class="list-group-item">Etat: <?php echo $res['choix_dispo_logement'] ?></li>
                            <li class="list-group-item">Situé :<?php echo $res['emplacement_logement'] ?></li>
                            <li class="list-group-item">Nombre de chambre : <?php echo $res['chambre_logement'] ?></li>
                            <li class="list-group-item">Nombre de salle de bain: <?php echo $res['sdb_logement'] ?></li>
                            <li class="list-group-item">Option du logement :<?php echo $res['choix_option_logement'] ?></li>
                            <li class="list-group-item"><?php echo $res['prix_logement'] ?>€/nuit</li>
                        </ul>
                    </div>
                </div>
                <form method="POST">
                    <button class="btn btn-danger btn-lg btn-block" name="Supprimer">Valider la suppression</button>
                </form>
                    <?php
                    if (isset($_POST['Supprimer'])) {
                    var_dump("ok click");
                    $this->DeleteGite();
                    }
                    ?>


            <?php
        }
    public function ShowLogementByIdReservation(){

        $db = $this->getPDO();
        $req = $db->prepare("SELECT * FROM logement WHERE `id_logement` = ? ");
        $ID=$_GET['ID'];
        $req->bindParam(1, $ID);
        $req->execute();

        $res=$req->fetch();
        ?>
        <!-- CARD -->
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class=" ">
            <div class="">
                <div class="">
                    <img class="" src="<?php echo $res['photo_logement'] ?>" alt="Card image cap">
                    <div class="">
                        <h5 class=""><?php echo $res['intitule_logement'] ?></h5>
                    </div>
                    <div>
                        <ul class="">
                            <li class="">iD logement: <?php echo $res['id_logement'] ?></li>
                            <li class=""><?php echo $res['prix_logement'] ?>€/nuit</li>
                        </ul>
                    </div>
                    <a href="index.php">Retour accueil</a>
                </div>
            </div>
        </div>
         <div class="col-8 ">
             <form class="" method="post" >
                 <h2> Formulaire de réservation. Merci de remplir tous les champs</h2>
                 <div>
                     <label for="nom">Nom</label>
                     <input type="text" id="Nom_client" name="Nom_client">
                 </div>
                 <div>
                     <label for="prenom">Prénom</label>
                     <input type="text" id="Prenom_client" name="Prenom_client">
                 </div>
                 <div>
                     <label for="arrivee">Date d'arrivée</label>
                     <input type="date" id="Arrivee_client" name="Arrivee_client">
                 </div>
                 <div>
                     <label for="sortie">Date de sortie</label>
                     <input type="date" id="Sortie_client" name="Sortie_client">
                 </div>
                 <div>
                     <label for="email">email</label>
                     <input type="email" id="Email_client" name="Email_client">
                 </div>
                 <div>
                     <label for="Message">Message(facultatif)</label>
                     <textarea id="Message_client" name="Message_client"></textarea>
                 </div>
                 <div>
                     <input type="hidden" value="<?php echo $res['intitule_logement'] ?>" name="Sujet">
                 </div>
                 <button type="submit" value="Reserver" name="validReservation" >Réserver</button>
             </form>
         </div>
        <?php
    }

    public function ShowLogementByIdDetails(){

        $db = $this->getPDO();
        $req = $db->prepare("SELECT * FROM logement INNER JOIN clef_type_logement ON logement.type_logement = clef_type_logement.id_type_logement 
                                                            INNER JOIN clef_dispo_logement ON logement.dispo_logement = clef_dispo_logement.id_dispo_logement
                                                            INNER JOIN clef_option_logement ON logement.option_logement = clef_option_logement.id_option_logement
                                                            WHERE id_logement = ?  ");
        $ID=$_GET['ID'];
        $req->bindParam(1, $ID);
        $req->execute();
        $res=$req->fetch();
        ?>

        <!-- CARD -->
        <div class="mt-2 text-center">
            <div class="card">
                <div class="card-body">
                    <h5 class=""><?php echo $res['intitule_logement'] ?></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><img class="" width="300" height="300" src="<?php echo $res['photo_logement'] ?>" alt="Card image cap"></li>
                    <li class="list-group-item"><?php echo $res['choix_type_logement'] ?></li>
                    <li class="list-group-item">Description: <?php echo $res['description_logement'] ?></li>
                    <li class="list-group-item">Etat: <?php echo $res['choix_dispo_logement'] ?></li>
                    <li class="list-group-item">Situé :<?php echo $res['emplacement_logement'] ?></li>
                    <li class="list-group-item">Nombre de chambre : <?php echo $res['chambre_logement'] ?></li>
                    <li class="list-group-item">Nombre de salle de bain: <?php echo $res['sdb_logement'] ?></li>
                    <li class="list-group-item">Option du logement :<?php echo $res['choix_option_logement'] ?></li>
                    <li class="list-group-item"><?php echo $res['prix_logement'] ?>€/nuit</li>
            </div>
            <a class="btn btn-success btn-lg btn-block m-2" href="ForumlaireReservationGite?ID=<?=$res["id_logement"]?>">Réserver ce gite</a>
            <a class="btn btn-danger " href="index.php">Retour accueil</a>
        </div>
        <?php
    }

    public function ShowLogementSearch(){

        $db = $this->getPDO();
        $DateArrivee=$_POST['search_arrivee'];
        $DateArrivee=$_POST['search_sortie'];
        $TypeChambre=$_POST['search_type_logement'];
        $NmbreChambre=$_POST['search_chambre'];

        $req = $db->query("SELECT * FROM logement WHERE `chambre_logement` = {$NmbreChambre}");

        foreach($req as $row){
        ?>
        <div class="">
            <div class="">
                <div class="">
                    <img class="" src="<?php echo $row['photo_logement'] ?>" alt="Card image cap">
                    <div class="">
                        <h5 class=""><?php echo $row['intitule_logement'] ?></h5>
                    </div>
                    <div>
                        <ul class="">
                            <li class="">Nombre de chambre : <?php echo $row['chambre_logement'] ?></li>
                            <li class="">Situé :<?php echo $row['emplacement_logement'] ?></li>
                            <li class="">Option du logement :<?php echo $row['option_logement'] ?></li>
                            <li class=""><?php echo $row['prix_logement'] ?>€/nuit</li>
                        </ul>
                    </div>
                </div>
                <a href="LogementDetails.php?ID=<?=$row["id_logement"]?>">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <?php
    }
    }

    public function addGite (){

        $db = $this->getPDO();

        $type_logement = $_POST['type_logement'];
        $intitule_logement = $_POST['intitule_logement'];
        $description_logement = $_POST['description_logement'];
        $photo_logement = $_POST['photo_logement'];
        $chambre_logement = $_POST['chambre_logement'];
        $sdb_logement = $_POST['sdb_logement'];
        $prix_logement = $_POST['prix_logement'];
        $emplacement_logement = $_POST['emplacement_logement'];
        $etat_logement = $_POST['etat_logement'];
        $option_logement = $_POST['option_logement'];



        
        $reqCreate ="INSERT INTO logement (type_logement, intitule_logement, description_logement, photo_logement, chambre_logement, sdb_logement, prix_logement, emplacement_logement, dispo_logement, option_logement) VALUES (?,?,?,?,?,?,?,?,?,?)";

        $requete_insertion = $db->prepare($reqCreate);

        $requete_insertion->bindParam(1, $type_logement);
        $requete_insertion->bindParam(2, $intitule_logement);
        $requete_insertion->bindParam(3, $description_logement);
        $requete_insertion->bindParam(4, $photo_logement);
        $requete_insertion->bindParam(5, $chambre_logement);
        $requete_insertion->bindParam(6, $sdb_logement);
        $requete_insertion->bindParam(7, $prix_logement);
        $requete_insertion->bindParam(8, $emplacement_logement);
        $requete_insertion->bindParam(9, $etat_logement);
        $requete_insertion->bindParam(10, $option_logement);


        $requete_insertion->execute(array($type_logement, $intitule_logement, $description_logement, $photo_logement,$chambre_logement, $sdb_logement, $prix_logement, $emplacement_logement, $etat_logement, $option_logement));

        if($requete_insertion){
            echo "C cool";
            //header("location:http://localhost/Projet_5_Gite/admin.php");
        }else{
            echo " remplir les champs";
        }
    }

    public function UpdateGite(){

        $db = $this->getPDO();

        $type_logement = $_POST['type_logement'];
        $intitule_logement = $_POST['intitule_logement'];
        $description_logement = $_POST['description_logement'];
        $photo_logement = $_POST['photo_logement'];
        $chambre_logement = $_POST['chambre_logement'];
        $sdb_logement = $_POST['sdb_logement'];
        $prix_logement = $_POST['prix_logement'];
        $emplacement_logement = $_POST['emplacement_logement'];
        $dispo_logement = $_POST['dispo_logement'];
        $ID = $_GET['ID'];

        $reqUpdate= $db->prepare("UPDATE `logement` SET `type_logement`= '$type_logement',`intitule_logement`= '$intitule_logement',`description_logement`= '$description_logement',`photo_logement`= '$photo_logement',`chambre_logement`= '$chambre_logement',`sdb_logement`= '$sdb_logement',`prix_logement`= '$prix_logement',`emplacement_logement`= '$emplacement_logement',`dispo_logement`= '$dispo_logement' WHERE `id_logement` = ?");
        $requete_insertion=$reqUpdate->execute(array($ID));

        if($requete_insertion){
            header("location:http://localhost/Projet_5_Gite_new/admin.php");
        }else{
            echo " remplir les champs";
        }
    }

    public function DeleteGite(){

        $db = $this->getPDO();
        $ID = $_GET['ID_suppr'];

        $reqDelete= $db->prepare("DELETE FROM `logement` WHERE `id_logement`= ?");
        $requete_insertion=$reqDelete->execute(array($ID));

        if($requete_insertion){
            header("location:http://localhost/Projet_5_Gite_new/admin.php");

        }else{
            echo " EchoTest";
        }

    }
    public function SearchGite(){
        $db = $this->getPDO();
        $req = $db->query("SELECT * FROM logement INNER JOIN clef_type_logement ON logement.type_logement = clef_type_logement.id_type_logement  ");
        ?>
        <div class="m-2">
            <form action="SearchLogement.php" method="post" >
                <div class="form-row">
                    <div class="col text-center">
                        <label for="type">Date d'arrivée</label>
                        <input class="form-control" type="date" id="search_arrivee" name="search_arrivee">
                    </div>
                    <div class="col text-center">
                        <label for="type">Date de sortie</label>
                        <input class="form-control" type="date" id="search_sortie" name="search_sortie">
                    </div>

                    <div class="col text-center">
                        <label for="type">Type de logement</label>
                        <select class="form-control" type="text" id="search_type_logement" name="search_type_logement">
                            <option> </option>
                            <?php
                            $this->LectureTypeLogement();
                            ?>
                        </select>
                    </div>
                    <div class="col text-center">
                        <label for="type">Option du logement</label>
                        <select class="form-control" type="text" id="search_type_logement" name="search_type_logement">
                            <option> </option>
                            <?php
                            $this->LectureOptionLogement();
                            ?>
                        </select>
                    </div>
                    <div class="col text-center">
                        <label for="type">Nombre de chambre</label>
                        <select class="form-control" id="search_chambre" name="search_chambre">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                </div>
            </form>
        </div>
    <?php
    }

    public function LectureEtatLogement(){

        $db = $this->getPDO();
        $req = $db->query("SELECT * FROM clef_dispo_logement");

        foreach($req as $row){
            ?>
            <option value="<?= $row['id_dispo_logement']?>"><?= $row['choix_dispo_logement']?></option>
            <?php
        }
    }

    public function LectureOptionLogement(){

        $db = $this->getPDO();
        $req = $db->query("SELECT * FROM clef_option_logement ");

        foreach($req as $row){
            ?>
            <option value="<?= $row['id_option_logement']?>"><?= $row['choix_option_logement']?></option>
            <?php
        }
    }

    public function LectureTypeLogement(){

        $db = $this->getPDO();
        $req = $db->query("SELECT * FROM clef_type_logement ");

        foreach($req as $row){
            ?>
            <option value="<?= $row['id_type_logement']?>"><?= $row['choix_type_logement']?></option>
            <?php
        }
    }
    public function UploadImg(){

    //Gestion upload image
    if(isset($_FILES['photo_logement'])){
    $target_dir = 'assets/img/';
    $img_gite = $target_dir . basename($_FILES['photo_logement']['name']);
    $_POST['photo_logement'] = $img_gite;
    var_dump($img_gite);

        if(move_uploaded_file($_FILES['photo_logement']['tmp_name'], $img_gite)){

        echo '<p class="alert-success">Le fichier est valide et à été téléchargé avec succès !</p>';
        }else{
            echo '<p class="alert-danger">Une erreur s\'est produite, le fichier n\'est pas valide !</p>';
        }
    }else{
        echo "<p class='alert-warning p-2'>Merci de respecter le format d'image valide : png, svg, jpg, jpeg, webp !</p>";
    }
    }

}