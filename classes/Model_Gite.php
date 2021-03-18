<?php
require "classes/database.php";

class ModelGite extends database{

    public function ShowLogement(){

        $db = $this->getPDO();
        $req = $db->query("SELECT * FROM `logement`ORDER BY `id_logement` DESC");

        foreach($req as $row){
            ?>
            <div class="col-3 mt-2">
                <!-- CARD -->
                <div class="card text-center cardAccueil">
                    <img class="d-block user-select-none imgCardAccueil" src="<?php echo $row['photo_logement'] ?>" alt="Card image cap">
                    <div class="card-body CaseIntitule">
                        <h5 class=""><?php echo $row['intitule_logement'] ?></h5>
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
                                                            INNER JOIN clef_departement_logement ON logement.departement_logement = clef_departement_logement.id_departement_logement
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
                            <li class="list-group-item">Département :<?php echo $row['nom_departement_logement'] ?></li>
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
                                                            INNER JOIN clef_departement_logement ON logement.departement_logement = clef_departement_logement.id_departement_logement
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
                            <li class="list-group-item">Département :<?php echo $res['nom_departement_logement'] ?></li>
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
        <div class="row container-fluid m-2">
            <div class="col-4 text-center">
                <div class="card">
                    <div class="card-body">
                        <h5 class=""><?php echo $res['intitule_logement'] ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><img class="" width="250" height="250" src="<?php echo $res['photo_logement'] ?>" alt="Card image cap"></li>
                    </ul>
                </div>
            </div>
            <div class="col-8 text-center formulaireResa">
                <form class="cm-2" method="post" >
                    <div class="form-row">
                         <div class="col form-group">
                             <label for="nom">Nom</label>
                             <input class="form-control" type="text" id="Nom_client" name="Nom_client">
                         </div>
                         <div class="col form-group">
                             <label for="prenom">Prénom</label>
                             <input class="form-control" type="text" id="Prenom_client" name="Prenom_client">
                         </div>

                         <div class="col form-group">
                             <label for="arrivee">Date d'arrivée</label>
                             <input class="form-control" type="date" id="Arrivee_client" name="Arrivee_client">
                         </div>
                         <div class="col form-group">
                             <label for="sortie">Date de sortie</label>
                             <input class="form-control" type="date" id="Sortie_client" name="Sortie_client">
                         </div>
                    </div>
                     <div class="form-group">
                         <label for="email">email</label>
                         <input class="form-control" type="email" id="Email_client" name="Email_client">
                     </div>
                     <div class="form-group">
                         <label for="Message">Message(facultatif)</label>
                         <textarea class="form-control" id="Message_client" name="Message_client"></textarea>
                     </div>
                     <div class="form-group">
                         <input class="form-control" type="hidden" value="<?php echo $res['intitule_logement'] ?>" name="Sujet">
                     </div>
                     <button class="btn btn-primary btn-lg btn-block" type="submit" value="Reserver" name="validReservation" >Réserver</button>
                 </form>
             </div>
        </div>

        <?php
    }

    public function ShowLogementByIdDetails(){

        $db = $this->getPDO();
        $req = $db->prepare("SELECT * FROM logement INNER JOIN clef_type_logement ON logement.type_logement = clef_type_logement.id_type_logement 
                                                            INNER JOIN clef_dispo_logement ON logement.dispo_logement = clef_dispo_logement.id_dispo_logement
                                                            INNER JOIN clef_option_logement ON logement.option_logement = clef_option_logement.id_option_logement
                                                            INNER JOIN clef_departement_logement ON logement.departement_logement = clef_departement_logement.id_departement_logement
                                                            WHERE id_logement = ?  ");
        $ID=$_GET['ID'];
        $req->bindParam(1, $ID);
        $req->execute();
        $res=$req->fetch();
        ?>

        <!-- CARD -->

        <div class="mt-2">
            <div class="divLogementById">
                <h2 class="text-center"><?php echo $res['intitule_logement'] ?></h2>
                <div class="row">
                    <div class="col-4 text-center">
                        <div class="divLogementByIdImg">
                            <img class="" width="300" height="300" src="<?php echo $res['photo_logement'] ?>" alt="Card image cap">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="divLogementByIdDescription">
                            <h6>Description:</h6>
                            <p> <?php echo $res['description_logement'] ?></p>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="divLogementByIdInfo">
                                    <h6> type de logement :</h6>
                                    <p> <?php echo $res['choix_type_logement'] ?></p>
                                </div>
                                <div class="divLogementByIdInfo">
                                    <h6>Localisation :</h6>
                                    <p><?php echo $res['emplacement_logement'] ?></p>
                                </div>

                            </div>
                            <div class="col-4">
                                <div class="divLogementByIdInfo">
                                    <h6>Option du logement :</h6>
                                    <p><?php echo $res['choix_option_logement'] ?></p>
                                </div>
                                <div class="divLogementByIdInfo">
                                    <h6>Département :</h6>
                                    <p><?php echo $res['nom_departement_logement'] ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="divLogementByIdInfo">
                                    <h6>Nombre de chambre :</h6>
                                    <p> <?php echo $res['chambre_logement'] ?></p>
                                </div>
                                <div class="divLogementByIdInfo">
                                    <h6>Nombre de salle de bain:</h6>
                                    <p> <?php echo $res['sdb_logement'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="divLogementByIdTarif">
                            <h6>Tarif :</h6>
                            <p><?php echo $res['prix_logement'] ?>€/nuit</p>
                        </div>

                    </div>
                </div>
                <div class="row m-2">
                    <?php
                    $this->ShowCommentaryById();
                    ?>
                </div>
            </div>
            <div class="text-center ">
                <a class="btn btn-success btn-lg btn-block m-2" href="FormulaireReservationGite?ID=<?=$res["id_logement"]?>">Réserver ce gite</a>
                <div>
                    <a class="btn btn-danger" href="index.php">Retour accueil</a>
                    <?php
                    if (isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true) {
                        ?>
                        <a class="btn btn-warning" href="AjoutCommentaire.php?ID=<?=$ID?>">Ajouter un commentaire</a>
                        <?php
                    }else{
                        ?>
                        <p></p>
                        <?php
                    }
                    ?>
                </div>

            </div>



        </div>
        <?php
    }

    public function ShowLogementSearch(){

        $db = $this->getPDO();
        $DateArrivee=$_POST['search_arrivee'];
        $Datedepart=$_POST['search_depart'];
        $TypeChambre=$_POST['search_type_logement'];
        $NmbreChambre=$_POST['search_chambre'];

        $req = $db->prepare("SELECT * FROM logement WHERE chambre_logement = ?
                                                            AND id_logement NOT IN (SELECT id_gite_booking FROM clef_booking_logement WHERE date_arrivee_booking <= ? AND date_depart_booking >= ?)
                                                         
                                    ");
        $req->bindParam(1,$NmbreChambre );
        $req->bindParam(2,$Datedepart);
        $req->bindParam(3,$DateArrivee);

        $req->execute();
        $rows=$req->fetchAll();

        foreach($rows as $row){
            ?>
            <div class="col-3 mt-2">
                <!-- CARD -->
                <div class="card text-center cardAccueil">
                    <img class="d-block user-select-none imgCardAccueil" src="<?php echo $row['photo_logement'] ?>" alt="Card image cap">
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

    public function ShowCommentaryById(){

        $db = $this->getPDO();
        $req = $db->prepare("SELECT * FROM clef_commentaire_logement WHERE id_gite_commentaire = ?  ");
        $ID=$_GET['ID'];
        $req->bindParam(1, $ID);
        $req->execute();
        $rows=$req->fetchAll();
        foreach($rows as $row){
        ?>
            <div class="mt-2 col-6 ">
                <div class="card divCom">
                    <div class="card-body">
                        <h5 class="divComTitre">Avis de : <?php echo $row['email_user_commentaire'] ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item divComCommentaire" ><?php echo $row['commentaire_gite'] ?></li>
                        <li class="list-group-item divComPrix">Note : <?php echo $row['note_gite']?> / 5</li>
                    </ul>
                </div>
            </div>
        <?php
        }
    }

    public function FormulaireCommentaireById(){

        $db = $this->getPDO();
        $req = $db->prepare("SELECT * FROM logement WHERE id_logement = ?  ");
        $ID=$_GET['ID'];
        $req->bindParam(1, $ID);
        $req->execute();
        $res=$req->fetch();
        ?>

        <div class="mt-2">
            <div class="row container-fluid m-2">
                <div class="col-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h5 class=""><?php echo $res['intitule_logement'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><img class="" width="250" height="250" src="<?php echo $res['photo_logement'] ?>" alt="Card image cap"></li>
                        </ul>
                    </div>
                </div>
                <div class="col-8 text-center formulaireResa">
                    <form class="cm-2" action="SaveCommentaire.php?ID=<?=$ID?>" method="post" >
                        <div class="form-row">
                            <div class="col-10 form-group">
                                <label for="email_admin_loger">Email</label>
                                <input required class="form-control text-center" type="text" value="<?=$_SESSION['email_user']?>" id="email_commentaire_user" name="email_commentaire_user" >
                            </div>
                            <div class="col-2 form-group">
                                <label for="Note">Note /5</label>
                                <select required class="form-control text-center" type="number" id="note_commentaire_user" name="note_commentaire_user">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="commentaire">Commentaire</label>
                                <textarea required class="form-control" type="text" id="commentaire_user" name="commentaire_user" rows="6">Votre commentaire</textarea>
                            </div>
                            <button class="btn btn-success m-2" type="submit" value="Connexion" name="Connexion" >Publier le commentaire</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center ">
                <a class="btn btn-danger" href="index.php">Retour accueil</a>
            </div>
        </div>
        <?php
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
        $departement_logement = $_POST['departement_logement'];

        
        $reqCreate ="INSERT INTO logement (type_logement, intitule_logement, description_logement, photo_logement, chambre_logement, sdb_logement, prix_logement, emplacement_logement, dispo_logement, option_logement,departement_logement) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

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
        $requete_insertion->bindParam(10, $departement_logement);


        $requete_insertion->execute(array($type_logement, $intitule_logement, $description_logement, $photo_logement,$chambre_logement, $sdb_logement, $prix_logement, $emplacement_logement, $etat_logement, $option_logement, $departement_logement));

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
        $departement_logement= $_POST['departement_logement'];
        $ID = $_GET['ID'];

        $reqUpdate= $db->prepare("UPDATE `logement` SET `type_logement`= '$type_logement',`intitule_logement`= '$intitule_logement',`description_logement`= '$description_logement',`photo_logement`= '$photo_logement',`chambre_logement`= '$chambre_logement',`sdb_logement`= '$sdb_logement',`prix_logement`= '$prix_logement',`emplacement_logement`= '$emplacement_logement',`dispo_logement`= '$dispo_logement',`departement_logement`= '$departement_logement' WHERE `id_logement` = ?");
        $requete_insertion=$reqUpdate->execute(array($ID));

        if($requete_insertion){
            var_dump($departement_logement);
            //header("location:http://localhost/Projet_5_Gite_new/admin.php");
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
                        <label for="type">Date de départ</label>
                        <input class="form-control" type="date" id="search_depart" name="search_depart">
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
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-dark m-2" type="submit">Rechercher</button>
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

    public function LectureDepartementLogement(){

        $db = $this->getPDO();
        $req = $db->query("SELECT * FROM clef_departement_logement ");

        foreach($req as $row){
            ?>
            <option value="<?= $row['id_departement_logement']?>"><?= $row['nom_departement_logement']?></option>
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

        if(move_uploaded_file($_FILES['photo_logement']['tmp_name'], $img_gite)){

        echo '<p class="alert-success">Le fichier est valide et à été téléchargé avec succès !</p>';
        }else{
            echo '<p class="alert-danger">Une erreur s\'est produite, le fichier n\'est pas valide !</p>';
        }
    }else{
        echo "<p class='alert-warning p-2'>Merci de respecter le format d'image valide : png, svg, jpg, jpeg, webp !</p>";
    }
    }

    public function ShowAllBooking(){

        $db = $this->getPDO();
        $req = $db->query("SELECT * FROM `clef_booking_logement` INNER JOIN logement ON clef_booking_logement.id_gite_booking = logement.id_logement ORDER BY `id_booking` DESC");

        foreach($req as $row){
            ?>
            <div class="row">
                <div class="col-3 text-center">
                    <?php echo $row['id_booking'] ?>
                </div>
                <div class="col-3 text-center">
                    <?php echo $row['intitule_logement'] ?>
                </div>
                <div class="col-3 text-center">
                    <?php echo $row['date_arrivee_booking'] ?>
                </div>
                <div class="col-3 text-center">
                    <?php echo $row['date_depart_booking'] ?>
                </div>
            </div>
            <?php
        }
    }
}