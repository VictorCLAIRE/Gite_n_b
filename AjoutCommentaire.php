<?php
session_start();
ob_start();
$title="Ajout d'un commentaire";
require "classes/Model_Gite.php";
$gite = new ModelGite();

$db = $gite->getPDO();
$ID = $_GET['ID'];

if (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] == true){

    $gite->FormulaireCommentaireById();
}elseif(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] == true){

    $gite->FormulaireCommentaireById();
}else{
    header("location:http://localhost/Projet_5_Gite_new/FormulaireConnexion.php");
}
?>

<?php
$content=ob_get_clean();
//Rappel du template sur chaque page
require "views/template.php";
?>