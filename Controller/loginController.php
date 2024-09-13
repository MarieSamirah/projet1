<?php
session_start();
include "../Model/Database.php";
include "../Model/Utilisateur.php";

if(isset($_POST['login']))
{
    $database = new Database();
    $db = $database->getConnection();

    $utilisateur = new Utilisateur($db);
    // $utilisateur->username = $_POST['username'];
    // $utilisateur->password = $_POST['password'];
    $username = $utilisateur->login($_POST['username'], $_POST['password']);
    if ($username != null) {
        $_SESSION['username'] = $username;
        header("Location: ../View/index.php");
        exit();
    }
    else {
        header("Location: ../View/login.php?error=Utilisateur introuvable sinon, veuillez-verifier le mot de pass");
        exit();
    }
}

if(isset($_POST['logout']))
{
    session_start();
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page or home page
    header("Location: ../View/login.php");
    exit();
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