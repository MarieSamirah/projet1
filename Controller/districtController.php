<?php
include "../Model/Database.php";
include "../Model/District.php";

if(isset($_POST['ajouter']))
{
    $database = new Database();
    $db = $database->getConnection();

    $district = new District($db);
    $district->nom = $_POST['nom'];
    $district->regionID = $_POST['region'];

    if ($district->create()) {
        header("Location: ../View/district.php");
        exit();
    }
}

if(isset($_POST['modifier']))
{
    $database = new Database();
    $db = $database->getConnection();

    $district = new District($db);
    $district->id = $_POST['id'];
    $district->nom = $_POST['nom'];
    $district->regionID = $_POST['region'];

    if ($district->update()) {
        header("Location: ../View/district.php");
        exit();
    }
}

if(isset($_POST['supprimer']))
{
    $database = new Database();
    $db = $database->getConnection();

    $district = new District($db);
    $district->id = $_POST['id'];

    if ($district->delete()) {
        header("Location: ../View/district.php");
        exit();
    }
}
?>