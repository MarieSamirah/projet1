<?php
include "../Model/Database.php";
include "../Model/Fokontany.php";

if(isset($_POST['ajouter']))
{
    $database = new Database();
    $db = $database->getConnection();

    $fokontany = new Fokontany($db);
    $fokontany->nom = $_POST['nom'];
    $fokontany->nom_chef = $_POST['nom_chef'];
    $fokontany->contact = $_POST['contact'];
    $fokontany->communeID = $_POST['commune'];

    if ($fokontany->create()) {
        header("Location: ../View/fokontany.php");
        exit();
    }
}

if(isset($_POST['modifier']))
{
    $database = new Database();
    $db = $database->getConnection();

    $fokontany = new Fokontany($db);
    $fokontany->id = $_POST['id'];
    $fokontany->nom = $_POST['nom'];
    $fokontany->nom_chef = $_POST['nom_chef'];
    $fokontany->contact = $_POST['contact'];

    if ($fokontany->update()) {
        header("Location: ../View/fokontany.php");
        exit();
    }
}

if(isset($_POST['supprimer']))
{
    $database = new Database();
    $db = $database->getConnection();

    $fokontany = new Fokontany($db);
    $fokontany->id = $_POST['id'];

    if ($fokontany->delete()) {
        header("Location: ../View/fokontany.php");
        exit();
    }
}


?>