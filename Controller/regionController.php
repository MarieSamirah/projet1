<?php
include "../Model/Database.php";
include "../Model/Region.php";

if(isset($_POST['ajouter']))
{
    $database = new Database();
    $db = $database->getConnection();

    $region = new Region($db);
    $region->nom = $_POST['nom'];
    $region->regionID = $_POST['region'];

    if ($region->create()) {
        header("Location: ../View/region.php");
        exit();
    }
}

if(isset($_POST['modifier']))
{
    $database = new Database();
    $db = $database->getConnection();

    $region = new Region($db);
    $region->id = $_POST['id'];
    $region->nom = $_POST['nom'];
    $region->regionID = $_POST['region'];

    if ($region->update()) {
        header("Location: ../View/region.php");
        exit();
    }
}

if(isset($_POST['supprimer']))
{
    $database = new Database();
    $db = $database->getConnection();

    $region = new Region($db);
    $region->id = $_POST['id'];

    if ($region->delete()) {
        header("Location: ../View/region.php");
        exit();
    }
}

?>