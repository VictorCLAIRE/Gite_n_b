<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Reservation
{

    public function reserverGite(){

        $nameClient=$_POST['Nom_client'];
        $prenomClient=$_POST['Prenom_client'];
        $arriveeClient=$_POST['Arrivee_client'];
        $sortieClient=$_POST['Sortie_client'];
        $emailClient=$_POST['Email_client'];
        $SujetClient=$_POST['Sujet'];

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'e9d3b60eb15a5e';                     //SMTP username
    $mail->Password   = 'a04b371000613d';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 2525;                                 //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->setLanguage('fr', '../vendore/phpmailer/phpmailer/language/');
    $mail->CharSet='UTF-8';

    //Recipients
    $mail->setFrom('Gitenb@example.com', 'Annonce RESA');
    $mail->addAddress('Gitenb@example.com', 'Annonce RESA');
    $mail->addReplyTo('Gitenb@example.com', 'Annonce RESA');

    $db = new PDO("mysql:host=localhost;dbname=projet_5_gite;charset=utf8", "root","");
    $req = $db->prepare("SELECT * FROM logement WHERE `id_logement` = ? ");
    $ID=$_GET['ID'];
    $req->bindParam(1, $ID);
    $req->execute();

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML

    $mail->Subject = "Validation de votre reservation du logement :" . $SujetClient;
    while ($datas= $req->fetch()){
        $ID = $_GET['ID'];
        $url = "http://localhost/Projet_5_Gite/ConfirmationReservation.php?id=$ID";

    $mail->Body    = '
 <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html">
        <title>Votre reservation chez locagite.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="background-color: #1D2326; color: #F0F1F2;">
    <div style="background-color: #F0F1F2; color: #1D2326; padding: 20px;">
        <img src="https://qiwo-indie-games.alwaysdata.net/assets/images/2.jpg" style="display: block; border-radius: 100%" width="50px" height="50px">
        <h3 style="color: #1D2326">LOCA-GITES.COM</h3>
        <!--INFOS DE DEBUG -->
        <p>ICI URL DU GITE A RESERVER : ' . $url . '</p>
        <p>ICI ID DU GITE A RESERVER: ' . $ID . '  </p>
    </div>
    <div style="padding: 20px;">
        <h1>Loca-gite.com</h1>
        <h2>Vous : '.$emailClient.'</h2>
        <p>Vous avez déposé une demande de reservation (ET C BIEN)  avec le liens suivant</p><br />
        <p>Recapitulatif de votre commande</p>
        <p>Nom du gite :<b style="color: yellow">'.$datas['intitule_logement'].'</b></p>
        <p>Description du gite :<b style="color: yellow"> '.$datas['description_logement'].'</b></p>
        <p>Image du gite :<img src="'.$datas['photo_logement'].'"/></p>
        <p>Prix par semaine du gite :<b style="color: yellow"> '.$datas['prix_logement'].' €</b></p>
        <p>Nombre de chambre :<b style="color: yellow"> '.$datas['chambre_logement'].'</b></p>
        <p>Nombre de salle de bain :<b style="color: yellow"> '.$datas['sdb_logement'].'</b></p>
        <p>Zone géographique :<b style="color: yellow"> '.$datas['emplacement_logement'].'</b></p>
        
        <p>Description du gite :<b style="color: yellow"> '.$datas['type_logement'].'</b></p>
        <p>Toutes fois vous avez la possibilité d\'annuler ou de confirmer votre commande</p>
        <br /><br />
        <a href="' . $url . '" style="background-color: darkred; color: #F0F1F2; padding: 20px; text-decoration: none;">Confimer la reservation de votre gite</a><br />
        <br />
        <p>Merci d\'utiliser notre site web</p>
        <p>Cordialement : Loca-gite.com: Michael MICHEL : Administrateur</p>    
    </div>
    </body>
    </html>
    ';
    $mail->body = "MIME-Version: 1.0" . "\r\n";
    $mail->body .= "Content-type:text/html;charset=utf8" . "\r\n";
}

            $mail->send();

            header("http://localhost/Projet_5_Gite/ConfirmationReservation.php?id=$ID");
        }catch (Exception $e){
    echo "<p class='alert-danger p-3'>Erreur lors de la tentative d'envoi de l'email {$mail->ErrorInfo}</p>";
    }

    }
}