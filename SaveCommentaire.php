<?php
    require "classes/Model_Gite.php";

    $gite = new ModelGite();

    $db = $gite->getPDO();

    $ID = $_GET['ID'];
    $email_commentaire_user=$_POST['email_commentaire_user'];
    $note_commentaire_user=$_POST['note_commentaire_user'];
    $commentaire_user=$_POST['commentaire_user'];

    var_dump($ID);
    var_dump($email_commentaire_user);
    var_dump($note_commentaire_user);
    var_dump($commentaire_user);

    $reqCreateCommentary ="INSERT INTO clef_commentaire_logement (id_gite_commentaire, email_user_commentaire, commentaire_gite, note_gite) VALUES (?,?,?,?)";

    $requete_insertion = $db->prepare($reqCreateCommentary);

    $requete_insertion->bindParam(1, $ID);
    $requete_insertion->bindParam(2, $email_commentaire_user);
    $requete_insertion->bindParam(3, $commentaire_user);
    $requete_insertion->bindParam(4, $note_commentaire_user);

    $requete_insertion->execute(array($ID, $email_commentaire_user, $commentaire_user, $note_commentaire_user));

    if($requete_insertion){
        echo "C cool";
        header("location:http://localhost/Projet_5_Gite_new/LogementDetails.php?ID=$ID");
    }else{
        echo " remplir les champs";
    }
