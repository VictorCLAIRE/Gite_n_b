<?php

class database
{
    //COONEXION A LE BASE de DONNÉES
    //Stock des valeur nom utilistateur phpmyadmin et mot de passe
    public function getPDO(){
        //Essaie de te connecter
        try{
            //Stockage et instance de la classe PDO pour connecter php et mysql
            $db = new PDO("mysql:host=localhost;dbname=projet_5_gite;charset=utf8", "root","");
            //Fonction static de la classe PDO pour debug la connexion en cas d'erreur
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;

        }catch(PDOException $exception){
            die ("Erreur de connexion a PDO MySQL :" .$exception->getMessage());
        }
    }


}
