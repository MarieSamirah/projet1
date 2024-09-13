<?php
include "../Model/Database.php";
include "../Model/recensement.php";

if(isset($_POST['ajouter']))
{
    $database = new Database();
    $db = $database->getConnection();

    $recensement = new Recensement($db);
    $recensement->nom_recensement = $_POST['recensement'];
    $recensement->observation = $_POST['observation'];

    if ($recensement->create()) {
        header("Location: ../View/recensement.php");
        exit();
    }
}

if(isset($_POST['modifier']))
{
    $database = new Database();
    $db = $database->getConnection();

    $recensement = new Recensement($db);
    $recensement->id = $_POST['id'];
    $recensement->nom_recensement = $_POST['recensement'];
    $recensement->observation = $_POST['observation'];

    if ($recensement->update()) {
        header("Location: ../View/recensement.php");
        exit();
    }
}
if(isset($_POST['supprimer']))
{
    $database = new Database();
    $db = $database->getConnection();

    $recensement = new Recensement($db);
    $recensement->id = $_POST['id'];
   

    if ($recensement->delete()) {
        header("Location: ../View/recensement.php");
        exit();
    }
}
?>


?>